<?php
//If the page is normal http, switch to secure.
if ($_SERVER["HTTPS"] != "on") {
    header('Location: https://' . $_SERVER["HTTPS"] . 'localhost' . $_SERVER["REQUEST_URI"]);
    exit();
}

//Initializing connection to MySQL database. Includes credentials and creates database connection in db_connection.php, all outside of root document. Also contains the session_start().
require_once("includes/db_connection.php");

//If opening this page from form's attempt to register, checks fields and creates user account if no errors are detected and handled. User is automatically logged in and redirected.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Sets and checks variables for all registration fields.
    if (isset($_POST['user_name'])) {
        $user_name = trim(htmlspecialchars($_POST['user_name']));
        if ($user_name == '')
            $error = 1; //Empty field error.
    }
    if (isset($_POST['name'])) {
        $name = trim(htmlspecialchars($_POST['name']));
        if ($name == '')
            $error = 1; //Empty field error.
    }
    if (isset($_POST['email'])) {
        $email = trim(htmlspecialchars($_POST['email']));
        if ($email == '')
            $error = 1; //Empty field error.
    }
    if (isset($_POST['password'])) {
        $password = trim(htmlspecialchars($_POST['password']));
        if ($password == '')
            $error = 1; //Empty field error.



            
//If the field for Confirm Password does not match the password entered above (password already cannot be blank), return an error.
        if (isset($_POST['confirm_password'])) {
            if ($_POST['confirm_password'] != $_POST['password'])
                $error = 2; //Confirm password error.
        }
    }

    //If no issues were detected from the input fields, create the new user and log them in.
    if (!isset($error)) {
        //Encrypts the password into a hashed password for the database to hold.
        $hash = password_hash($password, PASSWORD_DEFAULT);

        //set the db connection
        $db = create_db();
        //Query to insert the user's entered information into a new row in the users table. Enters the hashed password, and not the original password.
        $query = "INSERT INTO members (username, name, email, password_hash) VALUES (?, ?, ?, ?)";
        $stmt = $db->prepare($query);
        $stmt->bind_param('ssss', $user_name, $name, $email, $hash);
        $stmt->execute();

        //Logs in the user using the newest id generated from the above SQL INSERT statement.
        $_SESSION['valid_user'] = $db->insert_id;

        //Frees results and closes the connection to the database.
        $stmt->close();
        $db->close();

        if (isset($_SESSION['callback_url'])) { //If registering after attempting to access or add to bookmarks, redirect using http and the callback_url stored in the session. Unsets after setting url variable for the header statement to use.
            $url = "http://" . $_SERVER['SERVER_NAME'] . $_SESSION['callback_url'];
            unset($_SESSION['callback_url']);
            header('Location: ' . $url);
            ;
        } else { //If no callback_url exists, redirect the new user to the showmodels.php page.
            header('Location: showevents.php');
        }
    }
}
?>
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
        <form action="register.php" method="post">
            <?php
            //If any error was detected after attempting to register, a message is shown at the top of the form.
            if (isset($error)) {
                if ($error == 1) {
                    echo '<span class="error">All fields are required.</span>';
                }
                if ($error == 2) {
                    echo '<span class="error">Password was entered incorrectly. Please try again.</span>';
                }
            }
            ?>
            <table>
                <tr>
                    <td>
                        <label>Username</label>
                    </td>
                    <td>
                        <!-- Keeps the field filled if there was a error registering and the form displays again. -->
                        <input type="text" name="user_name" value="<?php if (isset($user_name)) echo $user_name ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <!-- Keeps the field filled if there was a error registering and the form displays again. -->
                        <input type="text" name="name" value="<?php if (isset($name)) echo $name ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Email</label>
                    </td>
                    <td>
                        <!-- Keeps the field filled if there was a error registering and the form displays again. -->
                        <input type="text" name="email" value="<?php if (isset($email)) echo $email ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Password</label>
                    </td>
                    <td>
                        <!-- Keeps the field filled if there was a error registering and the form displays again. -->
                        <input type="password" name="password" value="<?php if (isset($password)) echo $password ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Confirm Password</label>
                    </td>
                    <td>
                        <input type="password" name="confirm_password" value="">
                    </td>
                </tr>
            </table>
            <!-- Submit button. -->
            <input type="submit">
        </form>
        <?php
//Adds the footer.
        require('includes/footer.php');
        ?>
    </body>
</html>