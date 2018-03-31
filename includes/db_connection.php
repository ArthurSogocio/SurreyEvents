<?php 
//Restricts direct access via browser to this php page.
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
	die('403 FORBIDDEN: Direct access not allowed');
	exit();
};

//Initializing connection to MySQL database.
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "surreyevents";

//Creates the connection object used to run queries.
@ $db = new mysqli($servername, $username, $password, $dbname);

//Error message if connection fails.
if(mysqli_connect_errno()) {
	die("Database connection failed. Error Code: " . mysqli_connect_errno());
}

//Starts the session, which is present in every page.
session_start();
?>

