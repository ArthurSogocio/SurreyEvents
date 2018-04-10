<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//Initializing connection to MySQL database. Includes credentials and creates database connection in db_connection.php, all outside of root document. Also contains the session_start().
    require_once("../includes/db_connection.php");

    $rating = trim(htmlspecialchars($_POST['rating']));
    $event = trim(htmlspecialchars($_POST['event']));
    $user = trim(htmlspecialchars($_POST['user']));
    $userrating = "";

    //if $rating is not 0, that means that the user submitted a result; check data to insert into the table
    if ($rating != 0) {
        $userrating = "User Rating: $rating <br>";
        //one user may only rate one event once; check if user already rated selected event
        $searchquery = "SELECT id FROM ratings WHERE user_id = $user AND event_id = $event LIMIT 1";
        $searchresult = db_select($searchquery);

        //set the db connection
        $db = create_db();

        if (mysqli_num_rows($searchresult) == 0) {
            //if none found, insert into database
            //Query to insert the user's entered information into a new row in the users table. Enters the hashed password, and not the original password.
            $insertquery = "INSERT INTO ratings (user_id, event_id, rating) VALUES (?, ?, ?)";
            $stmt = $db->prepare($insertquery);
            $stmt->bind_param('iii', $user, $event, $rating);
            $stmt->execute();
        } else {
            //update the previous rating instead if the user already voted
            $updatequery = "UPDATE ratings SET rating = ? WHERE user_id = ? AND event_id = ?";
            $stmt = $db->prepare($updatequery);
            $stmt->bind_param('iii', $rating, $user, $event);
            $stmt->execute();
        }

        //Frees results and closes the connection to the database.
        $stmt->close();
        $db->close();
    } else {
        //check if user voted on current rating on page load; display user's rating if exists
        $searchquery = "SELECT rating FROM ratings WHERE user_id = $user AND event_id = $event LIMIT 1";
        $searchresult = db_select($searchquery);
        if (mysqli_num_rows($searchresult) != 0) {
            while ($row = mysqli_fetch_assoc($searchresult)) {
                $userrating = "User Rating:" . $row['rating'] . "<br>";
            }
        }
    }

    //display the rating to the page
    $query = "SELECT AVG(rating) AS rating, COUNT(rating) AS total FROM ratings where event_id = $event GROUP BY event_id";
    //echo $query;
    $result = db_select($query);
    while ($row = mysqli_fetch_assoc($result)) {
        echo "Rating: " . $row['rating'] . '<br>';
        echo $userrating;
        echo "Total Votes: " . $row['total'];
    }
}
?>