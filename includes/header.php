<table style="width:100%;">
    <tr class="main-title">
        <th><a href="index.php">Surrey Events</a></th>
        <td class="nav-bar">
            <a href="index.php">Home</a> | 
            <a href="showevents.php">Events</a> | 
            <a href="bookmarks.php">Bookmarks</a>
        </td>
        <td class="nav-login">
            <?php
            //Shows username and logout button if logged in.
            if (isset($_SESSION['valid_user']) && isset($_SESSION['valid_username'])) {
                $signed_in_user = $_SESSION['valid_username'];
                echo 'Welcome, <a class="logout" href="edituser.php">' . $signed_in_user . ' (Edit User)</a>    <a class="logout" href="logout.php">Logout</a>';
            } else {
                echo '<a class="login" href="login.php">Login</a>';
            }
            ?>
        </td>
    </tr>
</table>

