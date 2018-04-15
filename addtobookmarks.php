<?php
//Initializing connection to MySQL database. Includes credentials and creates database connection in db_connection.php, all outside of root document. Also contains the session_start().
require_once("includes/db_connection.php");

//If no one is logged in, redirect to login page. Kills page in case redirect fails.
if (!isset($_SESSION['valid_user'])) {
	$_SESSION['callback_url'] = $_SERVER['REQUEST_URI'];
	header('Location: login.php');
	die("There is an issue with the database. Please try again later.");
}

//Query to check if the bookmark item for this user and this event already exists.
$db = create_db();
$query = "SELECT user_id, event_id FROM bookmarks WHERE user_id = ? AND event_id = ?";
$stmt = $db->prepare($query);
$stmt->bind_param('is', $_SESSION['valid_user'], $_SESSION['event_viewed']);
$stmt->execute();
$stmt->bind_result($user_id, $event_id);

//If there is a bookmark item with the exact same user's id and event's event_id, event_added in the session is set with the event_id with "dataExists" attached so the bookmark can show a message saying the user already has that bookmark entry.
while ($stmt->fetch()) {
	if ($user_id == $_SESSION['valid_user'] && $event_id == $_SESSION['event_viewed']) {
		$_SESSION['event_added'] = $_SESSION['event_viewed'] . "dataExists";
		unset($_SESSION['event_viewed']); //Removes the event code from the session as it is no longer going to be used.
		header('Location: bookmarks.php'); //Redirects to the user's bookmarks.
		die("There is an issue with the database. Please try again later."); //Kills page in case the redirect fails.
	}
}

//If bookmark item does NOT already exist, performs the following:

//Inserts new row into bookmarks containing the user's id and the event's id.
$query = "INSERT INTO bookmarks (user_id, event_id) VALUES (?, ?)";
$stmt = $db->prepare($query);
$stmt->bind_param('is', $_SESSION['valid_user'], $_SESSION['event_viewed']);
$stmt->execute();
//Frees results and closes the connection to the database.
$stmt->close();
$db->close();

//event_added is set with the event's id so upon redirect, the bookmark page can show a confirmatory message using the event's id to get its name.
$_SESSION['event_added'] = $_SESSION['event_viewed'];
unset($_SESSION['event_viewed']); //Removes the successfully added event id from the session to disallow duplicate entry.
header('Location: bookmarks.php'); //Redirects to the user's bookmarks.
die("Successfully added this event to your bookmarks."); //Kills page in case the redirect fails.
?>