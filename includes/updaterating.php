<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Initializing connection to MySQL database. Includes credentials and creates database connection in db_connection.php, all outside of root document. Also contains the session_start().
    require_once("../includes/db_connection.php");

    //Gets rating details from the request.
    $rating = trim(htmlspecialchars($_POST['rating']));
    $event = trim(htmlspecialchars($_POST['event']));
    $user = trim(htmlspecialchars($_POST['user']));
    $userrating = ""; //Assumes the user's rating does not exist yet.

    //If $rating is not 0, that means that the user submitted a result; check data to insert into the table.
    if ($rating != 0) {
        $userrating = "Your rating: $rating <br>";
        //Each user may only rate each event once; check if user already rated the selected event.
        $searchquery = "SELECT id FROM ratings WHERE user_id = $user AND event_id = $event LIMIT 1";
        $searchresult = db_select($searchquery);

        //Set the db connection.
        $db = create_db();
        if (mysqli_num_rows($searchresult) == 0) {
            //If no rating was found, insert new one into database.
            $insertquery = "INSERT INTO ratings (user_id, event_id, rating) VALUES (?, ?, ?)";
            $stmt = $db->prepare($insertquery);
            $stmt->bind_param('iii', $user, $event, $rating);
            $stmt->execute();
        } else {
            //Update the previous rating instead if the user already voted.
            $updatequery = "UPDATE ratings SET rating = ? WHERE user_id = ? AND event_id = ?";
            $stmt = $db->prepare($updatequery);
            $stmt->bind_param('iii', $rating, $user, $event);
            $stmt->execute();
        }

        //Frees results and closes the connection to the database.
        $stmt->close();
        $db->close();
    } else { //If page was just loaded and no click on the ratings buttons have been made yet...
        //Check if user voted on current rating on page load; display user's rating if exists.
        $searchquery = "SELECT rating FROM ratings WHERE user_id = $user AND event_id = $event LIMIT 1";
        $searchresult = db_select($searchquery);
        if (mysqli_num_rows($searchresult) != 0) {
            while ($row = mysqli_fetch_assoc($searchresult)) {
                $userrating = "Your rating: " . $row['rating'] . "<br>";
            }
        }
    }

    //Display the overall rating on the page.
    $query = "SELECT AVG(rating) AS rating, COUNT(rating) AS total FROM ratings where event_id = $event GROUP BY event_id";
    $result = db_select($query);
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<h3>Rating: <span class='rating'>" . round($row['rating'], 1) . '</span> (' . $row['total'] . ' votes)<br>';
        echo $userrating . '</h3>';
    }
    
    //If no ratings exist yet, return rating as N/A.
    if ($result->num_rows == 0) {
        echo "<h3>Rating: N/A (0 votes)</h3>";
    }
}
?>