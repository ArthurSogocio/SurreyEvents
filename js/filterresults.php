<?php
//this file is accessed from showevents.php to populate the events table after being filtered
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//Initializing connection to MySQL database. Includes credentials and creates database connection in db_connection.php, all outside of root document. Also contains the session_start().
    require_once("../includes/db_connection.php");

    $name = trim(htmlspecialchars($_POST['name']));
    $category = trim(htmlspecialchars($_POST['category']));

//select query non-filtered
    $query = "SELECT events.*, categories.name FROM events "
            . "LEFT JOIN categories ON categories.id = events.category_id ";
    
    //set variable for category start: WHERE or AND
    $catstart = "WHERE ";

    if ($name != "") {
        //if the name field has content, apply it to the query
        $query .= "WHERE events.event_title LIKE '%" . $name . "%' ";
        
        //if name is initialized, category will begin with 'AND' instead of 'WHERE'
        $catstart = "AND ";
    }
    
    if ($category != 0) {
        //if the category was selected, filter by category
            $query .= $catstart . "categories.id = " . $category;
        }

    echo $query;

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
                    <th>Event Name</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Start Date</th>
                    <th>End Date</th>
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