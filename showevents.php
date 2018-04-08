<?php
//If the page is still secure from login or register pages, switch back to normal http.
if (isset($_SERVER["HTTPS"])) {
    if ($_SERVER["HTTPS"] == "on")
        header('Location: http://localhost' . $_SERVER["REQUEST_URI"]);
}

//Initializing connection to MySQL database. Includes credentials and creates database connection in db_connection.php, all outside of root document. Also contains the session_start().
require_once("includes/db_connection.php");

//query to select categories from dropdown
$catquery = "SELECT id, name FROM categories";
$catresult = db_select($catquery);

//query to select towns from dropdown
$townquery = "SELECT id, name FROM towns";
$townresult = db_select($townquery);

//If no one is logged in, clear the callback URL.
//This is because if they open showevents.php after getting a callback URL from trying to access their watchlist, they are not concerned with getting immediately redirected to the watchlist if they choose to log in normally after.
if (!isset($_SESSION['valid_user'])) {
    unset($_SESSION['callback_url']);
}
?>
<html>
    <head>
        <title>Surrey Events</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="js/jquery-3.3.1.js"></script>
        <script>
            //initialize category; start at 0 or "" means select all
            name = "";
            category = 0;
            town = "";
            recency = 0;

            //Ajax File to apply user filters to the table query - select = select changer, change = change applied to query; 
            function updateTable(select, change) {
                if (select == 'name') {
                    name = change;
                } else if (select == 'category') {
                    category = change;
                } else if (select == 'town') {
                    town = change;
                } else if (select == 'recency') {
                    recency = change;
                }


                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else {
                    // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }

                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("filterresults").innerHTML = this.responseText;

                        $("#pagination-nav").empty();
                        $("#pagination-nav").append("<li>[1]</li>")

                        $(".page").hide();
                        $(".page1").show();
                    }
                };
                xmlhttp.open("POST", "includes/filterresults.php", true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send("name=" + name + "&category=" + category + "&town=" + town + "&recency=" + recency);


                console.log("showpages?");


            }

            window.onload = updateTable();
        </script>
    </head>
    <body>
        <?php
        //Adds the header.
        require('includes/header.php');
        ?>
        <h1>Search Events</h1>
        <form>
            <table>
                <tr>
                    <th>Event Name</th>
                    <th>Category</th>
                    <th>Township</th>
                    <th>Upcoming/Past Event</th>
                </tr>
                <tr>
                    <td>
                        <input type="text" onkeyup="updateTable('name', this.value)">
                    </td>
                    <td>
                        <select name="users" onchange="updateTable('category', this.value)">
                            <option value="">Select a Category</option>
                            <?php
                            while ($catrow = mysqli_fetch_assoc($catresult)) {
                                $catid = $catrow['id'];
                                $catname = $catrow['name'];
                                ?>
                                <option value="<?= $catid ?>"><?= $catname ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </td>
                    <td>
                        <select name="users" onchange="updateTable('town', this.value)">
                            <option value="">Select a Town</option>
                            <option value="0">N/A</option>
                            <?php
                            while ($townrow = mysqli_fetch_assoc($townresult)) {
                                $townid = $townrow['id'];
                                $townname = $townrow['name'];
                                ?>
                                <option value="<?= $townid ?>"><?= $townname ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </td>
                    <td>
                        <select name="users" onchange="updateTable('recency', this.value)">
                            <option value="0">Upcoming Events</option>
                            <option value="1">Past Events</option>
                        </select>
                    </td>
                </tr>
            </table>
        </form>
        <ul id="pagination-nav">
            <!-- Nav buttons added after AJAX result. -->
        </ul>
        <div id="filterresults">
            <!-- display filtered results from ajax -->
        </div>
        <?php
        //Adds the footer.
        require('includes/footer.php');
        ?>
    </body>
</html>