<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Initializing connection to MySQL database. Includes credentials and creates database connection in db_connection.php, all outside of root document. Also contains the session_start().
    require_once("../includes/db_connection.php");

    //Gets comment details from the request.
    $comment = trim(htmlspecialchars($_POST['comment']));
    $event = trim(htmlspecialchars($_POST['event']));
    $user = trim(htmlspecialchars($_POST['user']));

    //If comment is not blank, insert the new comment.
    if ($comment != "") {
        //Query to insert the user's entered information into a new row in the comments table.
        $db = create_db();
        $insertquery = "INSERT INTO comments (user_id, event_id, comment) VALUES (?, ?, ?)";
        $stmt = $db->prepare($insertquery);
        $stmt->bind_param('iis', $user, $event, $comment);
        $stmt->execute();

        //Frees results and closes the connection to the database.
        $stmt->close();
        $db->close();
    }

    //Display the comments on the page.
    $query = "SELECT comments.comment as comment, comments.creation_date as date, members.username as username FROM comments LEFT JOIN members ON members.user_id = comments.user_id where event_id = $event ORDER BY creation_date";
    $result = db_select($query);

    //Below is the table created on the event page containing all comments related to it.
    ?>
    <table>
        <?php

        $i = 0; //To alternate colours every row.
        while ($row = mysqli_fetch_assoc($result)) {
            $i++;
            ?>
            <tr <?php if($i % 2 == 0) echo "style='background-color: #cef0b2;'"; else echo "style='background-color: #effce4;'" ?>>
                <!-- Commenter's details. -->
                <td style="width: 15%; padding: 0.5em;">
                    <?php
                    //Also adds link to the commenter's bookmarks.
                    echo "<a href='bookmarks.php?user=" . $row['username'] . "'>" . $row['username'] . "</a>";
                    echo "<br>";
                    echo date('Y/m/d', strtotime($row['date']));
                    ?>
                </td>
                <!-- Actual comment. -->
                <td class="comment">
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