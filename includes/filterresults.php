<?php
//This file is accessed from showevents.php to populate the events table after being filtered.

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//Initializing connection to MySQL database. Includes credentials and creates database connection in db_connection.php, all outside of root document. Also contains the session_start().
    require_once("../includes/db_connection.php");

    $name = trim(htmlspecialchars($_POST['name']));
    $category = trim(htmlspecialchars($_POST['category']));
    $town = trim(htmlspecialchars($_POST['town']));
    $recency = trim(htmlspecialchars($_POST['recency']));

    //Select query written without filters.
    $query = "SELECT events.*, categories.name AS category, towns.name AS town FROM events "
            . "LEFT JOIN categories ON categories.id = events.category_id "
            . "LEFT JOIN towns ON towns.id = events.town_id ";

    //Set variable for start: WHERE or AND.
    $start = "WHERE ";
    if ($name != "") {
        //If the name field has content, apply it to the query.
        $query .= "WHERE events.event_title LIKE '%" . $name . "%' ";
        //If name is initialized, next added filters will begin with 'AND' instead of 'WHERE'.
        $start = "AND ";
    }
    if ($category != 0) {
        //If the category was selected, filter by category.
        $query .= $start . "categories.id = " . $category . " ";
        //If name is initialized, next added filters will begin with 'AND' instead of 'WHERE'.
        $start = "AND ";
    }
    if ($town != "") {
        //If the category was selected, filter by category.
        $query .= $start . "events.town_id = " . $town . " ";
        //If name is initialized, next added filters will begin with 'AND' instead of 'WHERE'.
        $start = "AND ";
    }
    if ($recency == 0) {
        //Search for events that are upcoming (start date is after today).
        $query .= $start . "start_date >= CURDATE() ";
        //Order by closest to today.
        $order = "ASC";
    } else {
        //Search for events that are in the past (start date is before today).
        $query .= $start . "start_date < CURDATE() ";
        //Order by closest to today (inverse of above).
        $order = "DESC";
    }

    //Order results by the start date.
    $query .= "ORDER BY events.start_date $order";
    $result = db_select($query);

    //The below HTML populates the table in showevents.php.
    ?>
    <!DOCTYPE html>
    <html>
        <head></head>
        <body>
            <table>
                <tr>
                    <th>Event Name</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Town</th>
                    <th>Start Date</th>
                </tr>
                <?php
                //Starts from page 1, item 0. Pagination is 10 events per page.
                $page = 1;
                $count = 0;
                while ($row = mysqli_fetch_array($result)) {
                    //Format date output.
                    $startdateformat = date("l jS \of F Y", strtotime($row['start_date']));

                    //Pagination is 10 events per page.
                    $count++;
                    if($count >= 11) {
                        $count = 1;
                        $page++;
                    }
                    //Prints each item with event details and its page number as a class.
                    ?>
                    <tr class="page page<?php echo $page; ?>">
                        <td><a href="eventdetails.php?event_id=<?= $row['event_id'] ?>"><?= $row['event_title'] ?></td>
                        <td><?= $row['category'] ?></td>
                        <td><?= $row['description'] ?></td>
                        <td><?= $row['town'] ?></td>
                        <td><?= $startdateformat ?></td>
                    </tr>
                    <?php
                }

                //Last row allows showevents to know how many pages exist in total from the current filtered results AND alerts users they have reached the end of their results (or did not get any results if this is the only row).
                ?>
                <tr id="lastrow" class="page page<?php echo $page; ?>" data-index="<?php echo $page; ?>">
                    <td></td>
                    <td></td>
                    <td>End of results.</td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </body>
    </html> 
    <?php
}
?>