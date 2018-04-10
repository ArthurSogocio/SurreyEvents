<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//Initializing connection to MySQL database. Includes credentials and creates database connection in db_connection.php, all outside of root document. Also contains the session_start().
    require_once("../includes/db_connection.php");

    $comment = trim(htmlspecialchars($_POST['comment']));
    $event = trim(htmlspecialchars($_POST['event']));
    $user = trim(htmlspecialchars($_POST['user']));

    //if comment is not blank, insert new comment
    if ($comment != "") {
        //set the db connection
        $db = create_db();

        //if none found, insert into database
        //Query to insert the user's entered information into a new row in the comments table.
        $insertquery = "INSERT INTO comments (user_id, event_id, comment) VALUES (?, ?, ?)";
        $stmt = $db->prepare($insertquery);
        $stmt->bind_param('iis', $user, $event, $comment);
        $stmt->execute();

        //Frees results and closes the connection to the database.
        $stmt->close();
        $db->close();
    }

    //display the rating to the page
    $query = "SELECT comments.comment as comment, comments.creation_date as date, members.username as username FROM comments LEFT JOIN members ON members.user_id = comments.user_id where event_id = $event ORDER BY creation_date";
    //echo $query;
    $result = db_select($query);
    ?>
    <table>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td>
                    <?php
                    echo $row['username'] . " On " . date("l jS \of F Y", strtotime($row['date'])) . ":";
                    ?>
                </td>
                <td>
                    <?= $row['comment'] ?>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
    <?php
}
?>