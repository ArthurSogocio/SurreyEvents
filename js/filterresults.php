<?php
//this file is accessed from showevents.php to populate the events table after being filtered
//Initializing connection to MySQL database. Includes credentials and creates database connection in db_connection.php, all outside of root document. Also contains the session_start().
require_once("../includes/db_connection.php");

//select query non-filtered
$query = "SELECT events.*, categories.name FROM events "
        . "LEFT JOIN categories ON categories.id = events.category_id";
$result = db_select($query);
?>
<!DOCTYPE html>
<html>
    <head>
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
            }

            table, td, th {
                border: 1px solid black;
                padding: 5px;
            }

            th {text-align: left;}
        </style>
    </head>
    <body>
        <table>
            <tr>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Age</th>
                <th>Hometown</th>
                <th>Job</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_array($result)) {
                ?>
                <tr>
                    <td><?= $row['event_title'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['description'] ?></td>
                    <td><?= $row['start_date'] ?></td>
                    <td><?= $row['end_date'] ?></td>
                    <td><?= $row['event_title'] ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html> 