<html>
<head>
	<title>Assignment 4</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<table style="width:100%;">
	<tr class="main-title">
		<th>Classic Models</th>
	</tr>
	<tr>
		<td class="nav-bar">
			<a href="showmodels.php">All Models</a> | 
			<a href="watchlist.php">Watchlist</a> | 
			<?php
			if (isset($_SESSION['valid_user'])) {
				echo '<a class="logout" href="logout.php">Logout</a>';
			} else {
				echo '<a class="login" href="login.php">Login</a>';
			}
			?>
		</td>
		<tr class="main-content">
			<td>
<!--Header end-->


