<?php
//Initializing connection to MySQL database. Includes credentials and creates database connection in db_connection.php, all outside of root document. Also contains the session_start().
require_once("includes/db_connection.php");

//If no one is logged in, redirect to login page. Kills page in case redirect fails.
if (!isset($_SESSION['valid_user'])) {
	$_SESSION['callback_url'] = $_SERVER['REQUEST_URI'];
	header('Location: login.php');
	die("There is an issue with the database. Please try again later.");
}

//Prepared statement to get first and last name of the user logged in.
// $namequery = "SELECT name FROM members WHERE id = ?";
// $stmt = $db->prepare($namequery);
// $stmt->bind_param('i', $_SESSION['valid_user']);
// $stmt->execute();
// $stmt->bind_result($name);
// $stmt->fetch();

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
        <h1>
			<?php
				//Sets the page's heading with the name of user if exists.
				echo $_SESSION['valid_username'];
			?>'s bookmarks
		</h1>

		<?php
		//Query to get all watchlist items associated with user's id and every product attached to the watchlist item.
		$query = "SELECT bookmarks.event_id, events.event_title FROM bookmarks JOIN events ON bookmarks.event_id = events.event_id WHERE bookmarks.user_id = ?";

		$db = create_db(); //TEMP

		//Sets up the prepared statement again to run for product information, including the product code (for linking to modeldetails.php) and product name (for the list items).
		$stmt = $db->prepare($query);
		$stmt->bind_param('i', $_SESSION['valid_user']);
		$stmt->execute();
		$stmt->bind_result($event_id, $event_title);

		//Displays relevant message when opening watchlist from redirect by addtowatchlist.php (which provides the "event_added" item).
		if (isset($_SESSION['event_added'])) {
			while ($stmt->fetch()) { //Looks for the product added, most likely at the bottom of the results if a brand new entry.
				//Message to indicate user already has the product on their watchlist, indicated by having a "dataExists" string concantenated at the end of the product's code.
				if ($_SESSION['event_added'] == $event_id . "dataExists") echo '<span style="color: #eb9437;">' . $event_title . ' is already in your bookmarks.</span>';

				//Confirmatory message for adding a watchlist item.
				else if ($_SESSION['event_added'] == $event_id) echo '<span style="color: #479b61;">' . $event_title . ' has been successfully added to your bookmarks.</span>';
				
			}
			//Removes the event_added item so the message does not show again until another redirect by addtowatchlist.php.
			unset($_SESSION['event_added']);
		}

		//Brings cursor back to the top of the results.
		$stmt->execute();

		echo "<ul>";
		//Make new list item with link for every watchlist item.
		while ($stmt->fetch()) {
			echo '<li><a href=eventdetails.php?event_id="'.$event_id.'">'.$event_title.'</a></li>';
		}
		//Frees results and closes the connection to the database.
		$stmt->close();
		$db->close();

		echo "</ul>";
		?>

		<?php
        //Adds the footer.
        require('includes/footer.php');
        ?>
    </body>
</html>
