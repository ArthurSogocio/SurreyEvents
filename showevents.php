<?php
//If the page is still secure from login or register pages, switch back to normal http.
if (isset($_SERVER["HTTPS"])) {
    if ($_SERVER["HTTPS"] == "on")
        header('Location: http://localhost' . $_SERVER["REQUEST_URI"]);
}

//Initializing connection to MySQL database. Includes credentials and creates database connection in db_connection.php, all outside of root document. Also contains the session_start().
require_once("includes/db_connection.php");

//Query to populate the list of events based on recency: will only select upcoming events within a month's time.
$query = "SELECT event_id, event_title, start_date, DATEDIFF(start_date, CURDATE()) AS days_left FROM events WHERE start_date >= CURDATE() ORDER BY start_date LIMIT 5";
$result = db_select($query);

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
        <script>
            //Ajax File to apply user filters to the table query
            function showUser(str) {
                if (str == "") {
                    document.getElementById("filterresults").innerHTML = "";
                    return;
                } else {
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
                        }
                    };
                    xmlhttp.open("GET", "js/filterresults.php?q=" + str, true);
                    xmlhttp.send();
                }
            }
        </script>
    </head>
    <body>
        <?php
        //Adds the header.
        require('includes/header.php');
        ?>
        <h1>Upcoming Events</h1>
        <form>
            Event Name: <input type="text" onkeyup="showHint(this.value)">
        </form>
        <select name="users" onchange="showUser(this.value)">
            <option value="">Select a person:</option>
            <option value="1">Peter Griffin</option>
            <option value="2">Lois Griffin</option>
            <option value="3">Joseph Swanson</option>
            <option value="4">Glenn Quagmire</option>
        </select>
    </form>
    <div id="filterresults">
        <!-- display filtered results from ajax -->
    </div>
    <?php
    //Adds the footer.
    require('includes/footer.php');
    ?>
</body>
</html>