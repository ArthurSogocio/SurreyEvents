<table style="width:100%;">
    <tr class="main-title">
        <th><a href="index.php">Surrey Events</a></th>
        <td class="nav-bar">
            <a href="index.php">Home</a> | 
            <a href="showevents.php">Events</a> | 
            <a href="bookmarks.php">Bookmarks</a>
            
            <!-- SESSION DEBUGGING -->
            <?php
            // if (isset($_SESSION['valid_user'])) {
            //     echo "<br>valid user is: " . $_SESSION['valid_user'];
            //     echo "<br>last event viewed: " . $_SESSION['event_viewed'];
            // }
            ?>

        </td>
        <td class="nav-login">
            <?php
            if (isset($_SESSION['valid_user']) && isset($_SESSION['valid_username'])) {
                $signed_in_user = $_SESSION['valid_username'];
                echo 'Welcome, ' . $signed_in_user . ' <a class="logout" href="logout.php">(Logout)</a>';
            } else {
                echo '<a class="login" href="login.php">Login</a>';
            }
            ?>
        </td>
    </tr>
</table>

