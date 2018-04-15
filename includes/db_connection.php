<?php
//Restricts direct access via browser to this php page.
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('403 FORBIDDEN: Direct access not allowed');
    exit();
};

//Define constant variables for the database.
define("DB_SERVER", "localhost");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");
define("DB_TABLES", "surreyevents");

//Set current timezone.
date_default_timezone_set('America/Vancouver');

//Function to create the connection object used to run queries.
function create_db() {
    $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_TABLES);
    return $db;
}

//Function to connect to DB to return results from select queries. Immediately closes connection.
function db_select($query) {
    $db = create_db();
    //Error message if connection fails.
    if (mysqli_connect_errno()) {
        die("Database connection failed. Error Code: " . mysqli_connect_errno());
    }
    //Runs query.
    $result = mysqli_query($db, $query);
    return $result;
    mysqli_close($db);
}

//Starts the session, which is present in every page.
session_start();
?>

