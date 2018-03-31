<?php
//Starts the session to unset all variables, including the valid, active user.
session_start();
unset($_SESSION['valid_user']);
unset($_SESSION['valid_username']);
unset($_SESSION['callback_url']);
unset($_SESSION['event_viewed']);
session_destroy();

//Redirects to the homepage.
header('Location: index.php');
?>