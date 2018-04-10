<?php
//If the page is still secure from login or register pages, switch back to normal http.
if (isset($_SERVER["HTTPS"])) {
    if ($_SERVER["HTTPS"] == "on")
        header('Location: http://localhost' . $_SERVER["REQUEST_URI"]);
}

//Initializing connection to MySQL database. Includes credentials and creates database connection in db_connection.php, all outside of root document. Also contains the session_start().
require_once("includes/db_connection.php");

//Query to populate the list of events based on recency: will only select upcoming events within a month's time.
$query = "SELECT event_id, event_title, start_date, DATEDIFF(start_date, CURDATE()) AS days_left, img_url FROM events WHERE start_date >= CURDATE() ORDER BY start_date LIMIT 5";
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
    </head>
    <body>
        <?php
        //Adds the header.
        require('includes/header.php');
        ?>
        <table>
            <tr class="main-content">
                <td>
                    <h1>Upcoming</h1>
                    <ul>
                        <?php
                        $imagesrc = "assets/placeholder.png";
                        $imagecap = "";

                        while ($r = mysqli_fetch_assoc($result)) {
                            if ($imagecap == "") {
                                $imagesrc = $r['img_url'];
                                $imagecap = 'Image for <a href=eventdetails.php?event_id=' . $r["event_id"] . '>' . $r["event_title"] . '</a>';
                            }

                            $days_left = $r['days_left'];
                            $daysleftdisplay = '<br><span class="countdown">Starts ';
                            if ($days_left == 1) {
                                $daysleftdisplay .= '<span class="today">tomorrow</span>!';
                            } else if ($days_left > 0) {
                                $daysleftdisplay .= 'in <span class="days">' . $days_left . "</span> days";
                            } else {
                                $daysleftdisplay .= '<span class="today">today</span>!';
                            }
                            
                            echo '<li><a href=eventdetails.php?event_id=' . $r["event_id"] . '>' . $r["event_title"] . '</a> ' . $daysleftdisplay . '</span></li>';
                        }
                        ?>
                        
                    </ul>
                </td>
                <td style="width: 50%;">
                    <img src='<?php echo $imagesrc; ?>' style="width: 100%; height: auto;">
                        <figcaption><?php echo $imagecap; ?></figcaption>
                    </img>
                </td>
            </tr>
        </table>
        <?php
        //Adds the footer.
        require('includes/footer.php');
        ?>
    </body>
</html>