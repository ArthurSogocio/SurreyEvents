<?php
//Initializing connection to MySQL database. Includes credentials and creates database connection in db_connection.php, all outside of root document. Also contains the session_start().
require_once("includes/db_connection.php");

$db = create_db(); //TEMP

//If no one is logged in, redirect to login page. Kills page in case redirect fails.
if (!isset($_SESSION['valid_user'])) {
	header('Location: login.php');
	die("There is an issue with the database. Please try again later.");
}

if (!empty($_GET["event_id"]) && !empty($_SESSION['valid_user'])) {
	$query = "DELETE FROM bookmarks WHERE user_id = ? AND event_id = ?";
	$stmt = $db->prepare($query);
	$stmt->bind_param('is', $_SESSION['valid_user'], $event);

	foreach ($_GET["event_id"] as $e) {
		$event = $e;
		$stmt->execute();
	}
}

//Frees results and closes the connection to the database.
$stmt->close();
$db->close();

?>