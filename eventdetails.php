<?php
//Initializing connection to MySQL database. Includes credentials and creates database connection in db_connection.php, all outside of root document. Also contains the session_start().
require_once("includes/db_connection.php");

//Uses value in URL to load correct event information from database.
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (!empty($_GET['event_id'])) {
        //Query to get event information.

        $query = "SELECT events.*, categories.name AS category, towns.name AS town FROM events "
                . "LEFT JOIN categories ON categories.id = events.category_id "
                . "LEFT JOIN towns ON towns.id = events.town_id "
                . "WHERE event_id = " . $_GET['event_id'];
        $result = db_select($query);
    }
} else {
    //Kills page if no correct code for any product was provided in URL. (i.e. from direct access to page)
    die("Something went wrong. Please try again later.");
}
?>

<html>
    <head>
        <title>Surrey Events</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="js/jquery-3.3.1.js"></script>
        <script>
            //initialize rating as 0; get rating and user id
            rating = 0;
            event = <?= $_GET['event_id'] ?>;
            user = <?php
//if user is set, change user variable
if (isset($_SESSION['valid_user'])) {
    echo $_SESSION['valid_user'];
} else {
    echo '0';
}
?>;
            $(function () {
                //when rating is clicked, update rating
                $('input[name=rating]').click(function () {
                    rating = $('input[name=rating]:checked').val();
                    updateRating();
                });

                //Ajax File to apply user rating
                function updateRating() {
                    $.post("includes/updaterating.php", {rating: rating, event: event, user: user}, function (result) {
                        $("#updatedRating").html(result);
                    });
                }
                
                //run script on load
                updateRating();
            });
        </script>
    </head>
    <body>
        <?php
        //Adds the header.
        require('includes/header.php');
        ?>

        <?php
        //Kills page if data could not be attained.
        if (!$result) {
            die("No results were attained. Please try again later.");
        } else {
            //Using associative array from result, populate table columns with corresponding information.
            $array = mysqli_fetch_assoc($result);
            ?>
            <h1><?= $array["event_title"] //Heading of page.              ?></h1> 

            <div class='eventImg'>
                <?php
                if ($array["img_url"] != "")
                    echo "<img src=" . $array["img_url"] . "></img>";
                else
                    echo "<img src='assets/placeholder.png'></img>";
                ?>
            </div>
            <table class='details-table'>
                <tr>
                    <th>Category</th>
                    <th>Town</th>
                </tr>
                <tr>
                    <td><?= $array["category"] ?></td>
                    <td><?= $array["town"] ?></td>
                </tr>
                <tr>
                    <th>Start Date</th>
                    <th>End Date</th>
                </tr>
                <tr>
                    <?php
                    $startdateformat = date("l jS \of F Y", strtotime($array['start_date']));
                    $enddateformat = date("l jS \of F Y", strtotime($array['end_date']));
                    ?>
                    <td><?= $startdateformat ?></td>
                    <td><?= $enddateformat ?></td>
                </tr>
            </table>
            <table class='details-table'>
                <tr>
                    <td>
                        <h3>Address</h3>
                        <?php
                        if ($array["address"] != "")
                            "<p>" . $array["address"] . "</p>";
                        else
                            "<p>No address available.</p>";
                        ?>
                        <h3>Description</h3>
                        <p><?= $array["description"] ?></p>
                    </td>
                </tr>
                <tr>
                    <td style='padding-top: 15px;'>
                        <?php
                        //Website button.
                        if ($array["website_url"] != "") {
                            echo "<a class='button website-button' href=" . $array["website_url"] . " target='_blank'>Website</a>";
                        } else {
                            echo "<a class='button dead-button'>Website link unavailable.</a>";
                        }
                        //Add to bookmarks button.
                        ?>
                        <a href="addtobookmarks.php" class="button bookmark-button">Bookmark</a>
                    </td>
                </tr>
                <td>
                    <h3>Rating</h3>
                    <!-- Event rating options only show up if user is signed in -->
                    <?php
                    if (isset($_SESSION['valid_user'])) {
                        ?>
                        <h4 id="updatedRating"></h4>
                        <form action="#" id="rating">
                            <input type="radio" name="rating" value="1"> 1<br>
                            <input type="radio" name="rating" value="2"> 2<br>
                            <input type="radio" name="rating" value="3"> 3<br>
                            <input type="radio" name="rating" value="4"> 4<br>
                            <input type="radio" name="rating" value="5"> 5
                        </form>
                        <?php
                    }
                    ?>
                </td>
            </table>
            <?php
            //Saves this product code to session so addtowatchlist.php can make a new watchlist item with it, even after having to login or register.
            //Won't cause a mistaken entry because button to add to watchlist only ever appears after this statement.
            $_SESSION['event_viewed'] = $array["event_id"];

            //Frees results and closes the connection to the database.
            $result->free_result();
        }

        //Adds the footer.
        require('includes/footer.php');
        ?>
    </body>
</html>
