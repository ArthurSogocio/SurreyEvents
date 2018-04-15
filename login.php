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
    if (isset($_POST['email'])) {
        $email = trim(htmlspecialchars($_POST['email']));
        if ($email == '')
            $error = 1; //Empty field error.
    }
    if (isset($_POST['password'])) {
        $password = trim(htmlspecialchars($_POST['password']));
        if ($password == '')
            $error = 1; //Empty field error.
    }

    //If no issues were detected from the input fields, attempt to log the user in.
    if (!isset($error)) {
        //Query to get the user's information using the input email.
        $query = "SELECT user_id, username, password_hash FROM members WHERE email = '$email'";
        $result = db_select($query);
        //If no emails have the typed value, return credential error
        if (mysqli_num_rows($result) > 0) {
            //Verifies the input password with the encrypted password stored in the database. Sets valid_user with the user's id and redirects if it passes.
            while ($row = mysqli_fetch_assoc($result)) {
                $pass_hash = $row['password_hash'];
                if (password_verify($password, $pass_hash)) {
                    //set sessions for logged in user: user name and user id
                    $_SESSION['valid_user'] = $row['user_id'];
                    $_SESSION['valid_username'] = $row['username'];
                    if (isset($_SESSION['callback_url'])) { //If logging in after attempting to access or add to bookmarks, redirect using http and the callback_url stored in the session. Unsets after setting url variable for the header statement to use.
                        $url = "http://" . $_SERVER['SERVER_NAME'] . $_SESSION['callback_url'];
                        unset($_SESSION['callback_url']);
                        header('Location: ' . $url);
                        ;
                    } else { //If no callback_url exists, redirect the user to the homepage.
                        header('Location: index.php');
                    }
                } else {
                    $error = 2; //Incorrect password error.
                }
            }
        } else {
            $error = 2; //incorrect email error
        }
    }
}
?>

<!-- Actual form to login. Redirects to itself. -->
<html>
    <head>
        <title>Surrey Events</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <?php
        //Adds the header.
        require('includes/header.php');
        ?>
        <table>
            <tr class="main-content">
                <td>
                    <form action="login.php" method="post">
                        <?php
                        //If any error was detected after attempting to log in, a message is shown at the top of the form.
                        if (isset($error)) {
                            if ($error == 1)
                                echo '<span class="error">Please enter your username and password.</span>';
                            if ($error == 2)
                                echo '<span class="error">Your credentials were entered incorrectly. Please try again.</span>';
                        }
                        ?>
                        <table>
                            <tr>
                                <td>
                                    <label>Email</label>
                                </td>
                                <td>
                                    <!-- Keeps the field filled if there was a error logging in and the form displays again. -->
                                    <input type="text" name="email" value="<?php if (isset($email)) echo $email ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Password</label>
                                </td>
                                <td>
                                    <!-- Keeps the field filled if there was a error logging in and the form displays again. -->
                                    <input type="password" name="password" value="<?php if (isset($password)) echo $password ?>">
                                </td>
                            </tr>
                        </table>
                        <!-- Submit button. -->
                        <input type="submit" value="Login">
                    </form>
                    <!-- Link to the registration page. -->
                    <a href="register.php">Not registered yet? Register here.</a>
                </td>
            </tr>
        </table>
        <?php
        //Adds the footer.
        require('includes/footer.php');
        ?>
    </body>
</html>