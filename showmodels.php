<?php
//If the page is still secure from login or register pages, switch back to normal http.
if (isset($_SERVER["HTTPS"])) {
	if ($_SERVER["HTTPS"] == "on") header('Location: http://localhost' . $_SERVER["REQUEST_URI"]);
}

//Initializing connection to MySQL database. Includes credentials and creates database connection in db_connection.php, all outside of root document. Also contains the session_start().
require_once("includes/db_connection.php");

//Query to populate the list of products.
$query = "SELECT productCode, productName FROM products ORDER BY productName";
$result = mysqli_query($db, $query);

//Kills page if the products could not be attained.
if (!$result) {
	die("There is an issue with the database. Please try again later.");
}

//If no one is logged in, clear the callback URL.
//This is because if they open showmodels.php after getting a callback URL from trying to access their watchlist, they are not concerned with getting immediately redirected to the watchlist if they choose to log in normally after.
if (!isset($_SESSION['valid_user'])) unset($_SESSION['callback_url']);

//Adds the header.
require('includes/header.php');

echo '<h1>All Models</h1>';
echo '<ul>';

//Make new list item with link for every product.
while ($r = mysqli_fetch_assoc($result)) {
	echo '<li><a href=modeldetails.php?productCode="'.$r["productCode"].'">'.$r["productName"].'</a></li>';
}
//Frees result and closes the connection to the database.
$result->free_result();
$db->close();

echo '</ul>';

//Adds the footer.
require('includes/footer.php'); 
?>
