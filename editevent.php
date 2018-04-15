<?php
//Initializing connection to MySQL database. Includes credentials and creates database connection in db_connection.php, all outside of root document. Also contains the session_start().
require_once("includes/db_connection.php");

//Uses value in URL to load correct event information from database.
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    //check if user is signed in, and if they are admin
    if(isset($_SESSION['admin']) && isset($_SESSION['valid_user'])) {
        //check database to double check if user is actually an admin
        $adminquery = "SELECT is_admin FROM members WHERE user_id = " . $_SESSION['valid_user'];
        $adminresult = db_select($adminquery);
        
    }
    if (!empty($_GET['event_id'])) {
        //Query to get event information.

        $query = "SELECT * FROM events"
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
    </head>
    <body>
        <?php
        //Adds the header.
        require('includes/header.php');
        ?>

        <?php
        //Kills page if data could not be attained.
        if (!$result) {
            die("No event was selected. Please try again later.");
        } else {
            //Using associative array from result, populate table columns with corresponding information.
            $array = mysqli_fetch_assoc($result);
            ?>
            <h1><?= $array["event_title"] //Heading of page.      ?></h1> 

            <div class='eventImg'>
                <?php
                if ($array["img_url"] != "")
                    echo "<img src=" . $array["img_url"] . " onerror=\"this.src='assets/placeholder.png'\"></img>";
                else
                    echo "<img src='assets/placeholder.png'></img>";
                ?>
            </div>
            <table class='details-table'>
                <tr>
                    <td>
                        <div id="updatedRating"></div>
                    </td>
                    <td>
                        <!-- Event rating options only show up if user is signed in -->
                        <?php
                        if (isset($_SESSION['valid_user'])) {
                            ?>

                            <form action="#" id="rating">
                                <input type="radio" name="rating" value="1"> 1
                                <input type="radio" name="rating" value="2"> 2
                                <input type="radio" name="rating" value="3"> 3
                                <input type="radio" name="rating" value="4"> 4
                                <input type="radio" name="rating" value="5"> 5
                            </form>
                        </td>

                        <?php
                    } else {
                        ?>

                    <span>Please log in to give a rating.</span>
                    <?php
                }
                ?>

            </td>
        </tr>
        <tr>
            <th>Start Date</th>
            <th>Category</th>
        </tr>
        <tr>
            <?php
            $startdateformat = date("l jS \of F Y", strtotime($array['start_date']));
            $enddateformat = date("l jS \of F Y", strtotime($array['end_date']));
            ?>
            <td><?= $startdateformat ?>
                <?php
                $days_left = $array["days_left"];
                $daysleftdisplay = '<br><span class="countdown">Starts ';
                if ($days_left == 1) {
                    $daysleftdisplay .= '<span class="today">tomorrow</span>!';
                } else if ($days_left > 0) {
                    $daysleftdisplay .= 'in <span class="days">' . $days_left . "</span> days";
                } else if ($days_left == 0) {
                    $daysleftdisplay .= '<span class="today">today</span>!';
                } else {
                    $daysleftdisplay = '<br><span class="countdown"><span class="past">Past event</span>';
                }
                echo $daysleftdisplay . '</span>';
                ?>
            </td>
            <td><?= $array["category"] ?></td>

        </tr>
        <tr>
            <th>End Date</th>
            <th>Town</th>
        </tr>
        <tr>

            <td><?= $enddateformat ?></td>
            <td><?= $array["town"] ?></td>
        </tr>

    </table>
    <table class='details-table'>
        <tr>
            <td>
                <h3>Address</h3>
                <?php
                if ($array["address"] != "")
                    echo "<p>" . $array["address"] . "</p>";
                else
                    echo "<p>No address available.</p>";
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
        
    </table>
    <!-- Comments -->
    <table>
        <tr>
            <td>
                <h2>Related Events</h2>
                <?php
                $event = $_GET['event_id'];
                //get query for related events
                $relatedquery = "(SELECT events.event_title as title, events.event_id as id "
                        . "FROM repeating_events r1 "
                        . "LEFT JOIN repeating_events r2 ON r1.event_id = r2.next_event_id "
                        . "LEFT JOIN events ON events.event_id = r2.next_event_id "
                        . "WHERE r1.next_event_id = $event ) "
                        . "UNION (SELECT events.event_title as title, events.event_id as id "
                        . "FROM repeating_events "
                        . "LEFT JOIN events ON repeating_events.next_event_id = events.event_id "
                        . "WHERE repeating_events.event_id = $event ) "
                        . "UNION (SELECT e2.event_title as title, e2.event_id as id "
                        . "FROM events e1 "
                        . "LEFT JOIN events e2 ON e2.category_id = e1.category_id "
                        . "WHERE e1.event_id = $event ) LIMIT 9";
                $relatedresult = db_select($relatedquery);
                while ($rowrel = mysqli_fetch_assoc($relatedresult)) {
                    //do not show the current event
                    if ($rowrel['id'] != $event) {
                        echo "<a href='eventdetails.php?event_id=" . $rowrel['id'] . "'>" . $rowrel['title'] . "</a><br>";
                    }
                }
                ?>
            </td>
        </tr>
    </table>
    <table>
        <tr id="commentsection">
        <h2>Comments</h2>
        <td id="comments">

        </td>
        <tr>
        </tr>
        <tr>
            <td>
                <?php if (isset($_SESSION['valid_user'])) { ?>
                    <textarea id="newcomment" rows="4" cols="50"></textarea><br>
                    <button id="submitcomment">Submit Comment</button>
                <?php } else { ?>
                    <h3>Please log in to submit a comment.</h3>
                <?php } ?>

            </td>
        </tr>
    </table>
    <?php
    //Saves this product code to session so addtowatchlist.php can make a new watchlist item with it, even after having to login or register.
    //Won't cause a mistaken entry because button to add to watchlist only ever appears after this statement.
    $_SESSION['event_viewed'] = $array["event_id"];

    //Frees results and closes the connection to the database.
    $result->free_result();
}

// 	echo "</div>";
// 	echo "<table class='details-table'>";
// 	echo "<tr>";
// 		echo "<th>Start Date</th>";
// 		echo "<th>Category</th></tr>";
// 		$startdateformat = date("l jS \of F Y", strtotime($array['start_date']));
// 		echo "<tr><td>".$startdateformat;
// 		$days_left = $array["days_left"];
// 		$daysleftdisplay = '<br><span class="countdown">Starts ';
//            if ($days_left == 1) {
//                $daysleftdisplay .= '<span class="today">tomorrow</span>!';
//            } else if ($days_left > 0) {
//                $daysleftdisplay .= 'in <span class="days">' . $days_left . "</span> days";
//            } else if ($days_left == 0) {
//           		$daysleftdisplay .= '<span class="today">today</span>!';
//            } else {
//                $daysleftdisplay = '<br><span class="countdown"><span class="past">Past event</span>';
//            }
//            echo $daysleftdisplay . '</span>';
//            echo "</td>";
//            echo "<td>".$array["category"]."</td>";
// 	echo "</tr>";
// 	echo "<tr>";
// 		echo "<th>End Date</th>";
// 		echo "<th>Town</th></tr>";
// 		$enddateformat = date("l jS \of F Y", strtotime($array['end_date']));
// 		echo "<td>".$enddateformat."</td>";
// 		echo "<td>".$array["town"]."</td>";
// 	echo "</tr>";
// 	echo "</table>";
// 	echo "<table class='details-table'>";
// 	echo "<tr><td>";
// 	echo "<h3>Address</h3>";
// 	if ($array["address"] != "") echo "<p>".$array["address"]."</p>";
// 	else echo "<p>No address available.</p>";
// 	echo "<h3>Description</h3>";
// 	echo "<p>".$array["description"]."</p>";
// 	echo "</td></tr>";
// 	echo "<tr><td style='padding-top: 15px;'>";
// 	//Website button.
// 	if ($array["website_url"] != "") {
// 		echo "<a class='button website-button' href=" . $array["website_url"] . " target='_blank'>Website</a>";
// 	} else {
// 		echo "<a class='button dead-button'>Website link unavailable.</a>";
// 	}
// 	//Add to bookmarks button.
// 	echo '<a href="addtobookmarks.php" class="button bookmark-button">Bookmark</a>';
// 	echo "</td></tr>";
// 	echo "</table>";
// 	//Saves this product code to session so addtowatchlist.php can make a new watchlist item with it, even after having to login or register.
// 	//Won't cause a mistaken entry because button to add to watchlist only ever appears after this statement.
// 	$_SESSION['event_viewed'] = $array["event_id"];
// 	//Frees results and closes the connection to the database.
// 	$result->free_result();
// }
?>

<?php
//Adds the footer.
require('includes/footer.php');
?>
</body>
</html>
