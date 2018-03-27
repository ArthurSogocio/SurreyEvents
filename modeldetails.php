<?php
//Initializing connection to MySQL database. Includes credentials and creates database connection in db_connection.php, all outside of root document. Also contains the session_start().
require_once("includes/db_connection.php");

//Uses value in URL to load correct product information from database.
if ($_SERVER["REQUEST_METHOD"] == "GET") {
	if(!empty($_GET['productCode'])) {
		//Query to get product information.
		$query = "SELECT * FROM products WHERE productCode = " . $_GET['productCode'];
		$result = mysqli_query($db, $query);
	}
} else {
	//Kills page if no correct code for any product was provided in URL. (i.e. from direct access to page)
	die("Something went wrong. Please try again later.");
}

//Adds the header.
require('includes/header.php');

//Kills page if data could not be attained.
if (!$result) {
	die("No results were attained. Please try again later.");
} else {
	//Using associative array from result, populate table columns with corresponding information.
	$array = mysqli_fetch_assoc($result);
	echo "<h1>" . $array["productName"] . "</h1>"; //Heading of page.
	echo "<table class='details-table'><tr>"; //Row 1
	echo "<th>Product Code</th>";
	echo "<th>Product Line</th>";
	echo "<th>Product Scale</th>";
	echo "<th>Product Vendor</th>";
	echo "</tr><tr>"; //Row 2
	echo "<td>".$array["productCode"]."</td>";
	echo "<td>".$array["productLine"]."</td>";
	echo "<td>".$array["productScale"]."</td>";
	echo "<td>".$array["productVendor"]."</td>";
	echo "</tr></table><table class='details-table'><tr>";
	echo "<th>Product Description</th>";
	echo "<th>Quantity in Stock</th>";
	echo "<th>Buy Price</th>";
	echo "<th>MSRP</th>";
	echo "</tr><tr>"; //Row 3
	echo "<td>".$array["productDescription"]."</td>";
	echo "<td>".$array["quantityInStock"]."</td>";
	echo "<td>".$array["buyPrice"]."</td>";
	echo "<td>".$array["MSRP"]."</td>";
	echo "</tr></table>";

	//Saves this product code to session so addtowatchlist.php can make a new watchlist item with it, even after having to login or register.
	//Won't cause a mistaken entry because button to add to watchlist only ever appears after this statement.
	$_SESSION['productViewed'] = $array["productCode"];

	//Frees results and closes the connection to the database.
	$result->free_result();
	$db->close();

	//Add to Watchlist button.
	echo '<a href="addtowatchlist.php" class="anchor-button">Add to Watchlist</a>';
}

//Adds the footer.
require('includes/footer.php'); 
?>

