<?php
//this file is accessed from showevents.php to populate the events table after being filtered
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//Initializing connection to MySQL database. Includes credentials and creates database connection in db_connection.php, all outside of root document. Also contains the session_start().
    require_once("../includes/db_connection.php");

    $name = trim(htmlspecialchars($_POST['name']));
    $category = trim(htmlspecialchars($_POST['category']));
    $town = trim(htmlspecialchars($_POST['town']));
    $recency = trim(htmlspecialchars($_POST['recency']));

//select query non-filtered
    $query = "SELECT events.*, categories.name AS category, towns.name AS town FROM events "
            . "LEFT JOIN categories ON categories.id = events.category_id "
            . "LEFT JOIN towns ON towns.id = events.town_id ";

//set variable for start: WHERE or AND
    $start = "WHERE ";

    if ($name != "") {
        //if the name field has content, apply it to the query
        $query .= "WHERE events.event_title LIKE '%" . $name . "%' ";

        //if name is initialized, next added filters will begin with 'AND' instead of 'WHERE'
        $start = "AND ";
    }

    if ($category != 0) {
        //if the category was selected, filter by category
        $query .= $start . "categories.id = " . $category . " ";

        //if name is initialized, next added filters will begin with 'AND' instead of 'WHERE'
        $start = "AND ";
    }

    if ($town != "") {
        //if the category was selected, filter by category
        $query .= $start . "towns.id = " . $town . " ";

        //if name is initialized, next added filters will begin with 'AND' instead of 'WHERE'
        $start = "AND ";
    }

    if ($recency == 0) {
        //search for events that are upcoming (start date is after today)
        $query .= $start . "start_date >= CURDATE() ";

        //order by closest to today
        $order = "ASC";
    } else {
        //search for events that are in the past (start date is before today)
        $query .= $start . "start_date < CURDATE() ";

        //order by closest to today (inverse of above)
        $order = "DESC";
    }

//order by the start date
    $query .= "ORDER BY events.start_date $order";

//echo $query;
    $result = db_select($query);
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
                    <th>End Date</th>
                </tr>
                <?php
                while ($row = mysqli_fetch_array($result)) {
                    //format date output
                    $startdateformat = date("l jS \of F Y", strtotime($row['start_date']));
                    ?>
                    <tr>
                        <td><a href="eventdetails.php?event_id=<?=$row['event_id'] ?>"><?= $row['event_title'] ?></td>
                        <td><?= $row['category'] ?></td>
                        <td><?= $row['description'] ?></td>
                        <td><?= $row['town'] ?></td>
                        <td><?= $startdateformat ?></td>
                        <td><?= $row['end_date'] ?></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </body>
    </html> 
    <?php
}
?>