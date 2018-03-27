<?php
//If the page is normal http, switch to secure.
if ($_SERVER["HTTPS"] != "on") {
	header('Location: https://' . $_SERVER["HTTPS"] . 'localhost' . $_SERVER["REQUEST_URI"]);
	exit();
}

//Initializing connection to MySQL database. Includes credentials and creates database connection in db_connection.php, all outside of root document. Also contains the session_start().
require_once("includes/db_connection.php");

//If opening this page from form's attempt to log in, checks credentials and logs in the user if no errors are detected and handled.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	//Sets and checks variables for the input email and password.
	if(isset($_POST['email'])) {
		$email = trim(htmlspecialchars($_POST['email']));
		if ($email == '') $error = 1; //Empty field error.
	}
	if(isset($_POST['password'])) {
		$password = trim(htmlspecialchars($_POST['password']));
		if ($password == '') $error = 1; //Empty field error.
	}

	//If no issues were detected from the input fields, attempt to log the user in.
	if (!isset($error)) {
		//Query to get the user's information using the input email.
		$query = "SELECT id, hashed_password FROM users WHERE email = ?";
		$stmt = $db->prepare($query);
		$stmt->bind_param('s', $email);
		$stmt->execute();
		$stmt->bind_result($user_id, $pass_hash);

		//Verifies the input password with the encrypted password stored in the database. Sets valid_user with the user's id and redirects if it passes.
		if ($stmt->fetch() && password_verify($password, $pass_hash)) {
			$_SESSION['valid_user'] = $user_id;
			if (isset($_SESSION['callback_url'])) { //If logging in after attempting to access or add to watchlist, redirect using http and the callback_url stored in the session. Unsets after setting url variable for the header statement to use.
				$url = "http://". $_SERVER['SERVER_NAME'] . $_SESSION['callback_url'];
				unset($_SESSION['callback_url']);
				header('Location: ' . $url);  ;
			} else { //If no callback_url exists, redirect the user to the showmodels.php page.
				header('Location: showmodels.php');
			}
		} else {
			$error = 2; //Incorrect password error.
		}
		//Frees results and closes the connection to the database.
		$stmt->close();
		$db->close();
	}
}

//Adds the header.
require('includes/header.php');
?>
	
<form action="login.php" method="post">
	<?php
	//If any error was detected after attempting to log in, a message is shown at the top of the form.
	if (isset($error)) {
		if ($error == 1) echo '<span class="error">Please enter your username and password.</span>';
		if ($error == 2) echo '<span class="error">Your credentials were entered incorrectly. Please try again.</span>';
	}
	?>
	<table>
		<tr>
			<td>
				<label>Email</label>
			</td>
			<td>
				<!-- Keeps the field filled if there was a error logging in and the form displays again. -->
				<input type="text" name="email" value="<?php if(isset($email)) echo $email ?>">
			</td>
		</tr>
		<tr>
			<td>
				<label>Password</label>
			</td>
			<td>
				<!-- Keeps the field filled if there was a error logging in and the form displays again. -->
				<input type="password" name="password" value="<?php if(isset($password)) echo $password ?>">
			</td>
		</tr>
	</table>
	<!-- Submit button. -->
	<input type="submit" value="Login">
</form>
<!-- Link to the registration page. -->
<a href="register.php">Not registered yet? Register here.</a>

<?php
//Adds the footer.
require('includes/footer.php'); 
?>

