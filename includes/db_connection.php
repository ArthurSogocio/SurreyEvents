<?php

//Restricts direct access via browser to this php page.
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('403 FORBIDDEN: Direct access not allowed');
    exit();
};

//define constant variables for the database
define("DB_SERVER", "localhost");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");
define("DB_TABLES", "surreyevents");

function create_db() {
    //Creates the connection object used to run queries.
    $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_TABLES);

    return $db;
}

//connect to for select queries
function db_select($query) {
    //Creates the connection object used to run queries.
    $db = create_db();

//Error message if connection fails.
    if (mysqli_connect_errno()) {
        die("Database connection failed. Error Code: " . mysqli_connect_errno());
    }

    //run query
    $result = mysqli_query($db, $query);
    return $result;

    mysqli_close($db);
}

//Creates table for "users" if does not exist.
/*
  if ($result = $db->query("SHOW TABLES LIKE 'users'")) {
  if($result->num_rows < 1) $db->query("CREATE TABLE users (
  id int(11) NOT NULL AUTO_INCREMENT,
  first_name varchar(255),
  last_name varchar(255),
  email varchar(255),
  hashed_password varchar(255),
  PRIMARY KEY (id)
  )");
  }
  else {
  die("Something went wrong with the database. Please try again later.");
  }

  //Creates table for "watchlistitems" if does not exist.
  if ($result = $db->query("SHOW TABLES LIKE 'watchlistitems'")) {
  if($result->num_rows < 1) $db->query("CREATE TABLE watchlistitems (
  id int(6) NOT NULL AUTO_INCREMENT,
  user_id int(11),
  product_id varchar(15),
  PRIMARY KEY (id)
  )");
  }
  else {
  die("Something went wrong with the database. Please try again later.");
  }

 */

//Starts the session, which is present in every page.
session_start();
?>

