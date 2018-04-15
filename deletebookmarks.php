<?php
//Initializing connection to MySQL database. Includes credentials and creates database connection in db_connection.php, all outside of root document. Also contains the session_start().
require_once("includes/db_connection.php");

//If no one is logged in, redirect to login page. Kills page in case redirect fails.
if (!isset($_SESSION['valid_user'])) {
	header('Location: login.php');
	die("There is an issue with the database. Please try again later.");
}

//Performs the deletion query if a user is logged in, an event id is specified in the URL for this script, and the bookmark items to be deleted contain both of those values.
if (!empty($_GET["event_id"]) && !empty($_SESSION['valid_user'])) {
	$db = create_db();
	$query = "DELETE FROM bookmarks WHERE user_id = ? AND event_id = ?";
	$stmt = $db->prepare($query);
	$stmt->bind_param('is', $_SESSION['valid_user'], $event);

	//Goes through each event id in the provided array.
	foreach ($_GET["event_id"] as $e) {
		$event = $e;
		$stmt->execute();
	}

	//Frees results and closes the connection to the database.
	$stmt->close();
	$db->close();
}
?>