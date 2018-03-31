<table style="width:100%;">
    <tr class="main-title">
        <th>Surrey Events</th>
    </tr>
    <tr>
        <td class="nav-bar">
            <a href="showevents.php">All Events</a> | 
            <a href="bookmarks.php">Bookmarks</a> | 
            <?php
            if (isset($_SESSION['valid_user'])) {
                echo '<a class="logout" href="logout.php">Logout</a>';
            } else {
                echo '<a class="login" href="login.php">Login</a>';
            }
            ?>
        </td>
    </tr>
</table>

