<?php
//Initializing connection to MySQL database. Includes credentials and creates database connection in db_connection.php, all outside of root document. Also contains the session_start().
require_once("includes/db_connection.php");

//Uses value in URL to load correct event information from database.
if ($_SERVER["REQUEST_METHOD"] == "GET" || $_SERVER["REQUEST_METHOD"] == "POST") {
//check if user is signed in, and if they are admin
    if (isset($_SESSION['admin']) && isset($_SESSION['valid_user'])) {
//check database to double check if user is actually an admin
        $adminquery = "SELECT is_admin FROM members WHERE user_id = " . $_SESSION['valid_user'] . " LIMIT 1";
        $adminresult = db_select($adminquery);
        $admin = mysqli_fetch_assoc($adminresult);
        if ($admin['is_admin'] == 1) {
            //if the user previously submitted this form, then update the data with the given fields
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $event_title = trim(htmlspecialchars($_POST['event_title']));
                $category_id = trim(htmlspecialchars($_POST['category_id']));
                $address = trim(htmlspecialchars($_POST['address']));
                $town_id = trim(htmlspecialchars($_POST['town_id']));
                $description = trim(htmlspecialchars($_POST['description']));
                $start_date = trim(htmlspecialchars($_POST['start_date']));
                $end_date = trim(htmlspecialchars($_POST['end_date']));
                $img_url = trim(htmlspecialchars($_POST['img_url']));
                $website_url = trim(htmlspecialchars($_POST['website_url']));

                //set the db connection
                $db = create_db();
                $query = "UPDATE events SET "
                        . "event_title = ?, "
                        . "category_id = ?, "
                        . "address = ?, "
                        . "town_id = ?, "
                        . "description = ?, "
                        . "start_date = ?, "
                        . "end_date = ?, "
                        . "img_url = ?, "
                        . "website_url = ? "
                        . "WHERE event_id = " . $_GET['event_id'];
                $stmt = $db->prepare($query);
                $stmt->bind_param('sisisssss', $event_title, $category_id, $address, $town_id, $description, $start_date, $end_date, $img_url, $website_url);
                $stmt->execute();
                
                //set field to let users know if the submit was a success
                $edited = 1;

                //Frees results and closes the connection to the database.
                $stmt->close();
                $db->close();
            }

            if (!empty($_GET['event_id'])) {
//Query to get event information.

                $query = "SELECT * FROM events "
                        . "WHERE event_id = " . $_GET['event_id'] . " LIMIT 1";
                $result = db_select($query);
                $eventdetails = mysqli_fetch_assoc($result);
            }
            ?>

            <html>
                <head>
                    <title>Surrey Events</title>
                    <link rel="stylesheet" type="text/css" href="css/style.css">
                </head>
                <body>
                    <?php
                    //Adds the header.
                    require('includes/header.php');
                    //create form to resubmit to this page; edit all of the event's fields
                    ?>
                    <h1>Edit Event</h1>
                    <?php
                        if (isset($edited)) {
                            echo "<h2>Success! This event has been edited.</h2>";
                        }
                    ?>
                    <form action="<?= $_SERVER['PHP_SELF'] ?>?event_id=<?= $_REQUEST['event_id'] ?>" method='POST'>
                        <table width ='100%'>
                            <tr>
                                <th>Event Name</th>
                                <td><input type="text" name="event_title" value='<?= $eventdetails['event_title'] ?>'></td>
                            </tr>
                            <tr>
                                <th>Category</th>
                                <td>
                                    <select name='category_id'>
                                        <option value='0' <?php
                                        if ($eventdetails['category_id'] == 0)
                                            echo 'selected';
                                        ?>>N/A</option>
                                                <?php
                                                //run query to get category names from id
                                                $catquery = "SELECT ID, NAME FROM CATEGORIES";
                                                $catresult = db_select($catquery);
                                                while ($catrow = mysqli_fetch_assoc($catresult)) {
                                                    ?>
                                            <option value='<?= $catrow['ID'] ?>' <?php
                                            if ($eventdetails['category_id'] == $catrow['ID'])
                                                echo 'selected';
                                            ?>><?= $catrow['NAME'] ?></option>
                                                    <?php
                                                }
                                                ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td><input type="text" name="address" value='<?= $eventdetails['address'] ?>'></td>
                            </tr>
                            <tr>
                                <th>Township</th>
                                <td>                                    
                                    <select name='town_id'>
                                        <option value='0' <?php
                                        if ($eventdetails['town_id'] == 0) {
                                            echo 'selected';
                                        }
                                        ?>>N/A</option>
                                                <?php
                                                //run query to get town names from id
                                                $townquery = "SELECT ID, NAME FROM TOWNS";
                                                $townresult = db_select($townquery);
                                                while ($townrow = mysqli_fetch_assoc($townresult)) {
                                                    ?>
                                            <option value='<?= $townrow['ID'] ?>'<?php
                                            if ($eventdetails['town_id'] == $townrow['ID']) {
                                                echo 'selected';
                                            }
                                            ?>><?= $townrow['NAME'] ?></option>
                                                    <?php
                                                }
                                                ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Description</th>
                                <td><textarea name="description"><?= $eventdetails['description'] ?></textarea></td>
                            </tr>
                            <tr>
                                <th>Start Date (Format: YYYY-MM-DD)</th>
                                <td><input type="text" name="start_date" value='<?= $eventdetails['start_date'] ?>'></td>
                            </tr>
                            <tr>
                                <th>End Date (Format: YYYY-MM-DD)</th>
                                <td><input type="text" name="end_date" value='<?= $eventdetails['end_date'] ?>'></td>
                            </tr>
                            <tr>
                                <th>Image</th>
                                <td><textarea name="img_url"><?= $eventdetails['img_url'] ?></textarea></td>
                            </tr>
                            <tr>
                                <th>Website URL</th>
                                <td><textarea name="website_url"><?= $eventdetails['website_url'] ?></textarea></td>
                            </tr>
                            <tr>
                                <th></th>
                                <td><input type="submit" value="Save Changes"></td>
                            </tr>
                        </table>
                    </form>
                    <?php
//Adds the footer.
                    require('includes/footer.php');
                    ?>
                </body>
                <?php
            }
            ?>
        </html>
        <?php
    } else {
        //redirect the page if the user is not an admin
        header("Location: index.php");
    }
} else {
//Kills page if no correct code for any product was provided in URL. (i.e. from direct access to page)
    die("Something went wrong. Please try again later.");
}
?>

