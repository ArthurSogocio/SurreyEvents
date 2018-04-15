<?php
//Initializing connection to MySQL database. Includes credentials and creates database connection in db_connection.php, all outside of root document. Also contains the session_start().
require_once("includes/db_connection.php");

//Uses value in URL to load correct event information from database.
if ($_SERVER["REQUEST_METHOD"] == "GET" || $_SERVER["REQUEST_METHOD"] == "POST") {
    //Check if user is signed in, and if they are admin.
    if (isset($_SESSION['valid_user'])) {
        //If the user previously submitted this form, then update the data with the given fields.
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = trim(htmlspecialchars($_POST['username']));
            $name = trim(htmlspecialchars($_POST['name']));
            $email = trim(htmlspecialchars($_POST['email']));
            $sharing = trim(htmlspecialchars($_POST['sharing']));
            $password = trim(htmlspecialchars($_POST['password']));
            $new_password = trim(htmlspecialchars($_POST['new_password']));
            $confirm_password = trim(htmlspecialchars($_POST['confirm_password']));
            $errors = '';

            //Check if password matches user.
            $passcheckquery = "SELECT password_hash FROM members WHERE user_id=" . $_SESSION['valid_user'] . " LIMIT 1";
            $passcheckresult = db_select($passcheckquery);
            $passcheckrow = mysqli_fetch_assoc($passcheckresult);
            if (password_verify($password, $passcheckrow['password_hash'])) {

                //Set the db connection.
                $db = create_db();
                //Set the initial query.
                $query = "UPDATE members SET "
                        . "username = ?, "
                        . "name = ?, "
                        . "email = ?, "
                        . "sharing = ? "
                        . " WHERE user_id = " . $_SESSION['valid_user'];
                $stmt = $db->prepare($query);
                $stmt->bind_param('ssss', $username, $name, $email, $sharing);
                $stmt->execute();

                //Add password field if new password is added, new update query.
                if ($new_password != '') {
                    if ($new_password == $confirm_password) {
                        $new_hash = password_hash($new_password, PASSWORD_DEFAULT);

                        $query = "UPDATE members SET "
                                . "password_hash = ? "
                                . " WHERE user_id = " . $_SESSION['valid_user'];
                        $stmt = $db->prepare($query);
                        $stmt->bind_param('s', $new_hash);
                        $stmt->execute();
                    } else {
                        $errors .= "Error: New Password does not match; Password has not been updated";
                    }
                }

                //Set field to let users know if the submit was a success.
                $edited = 1;

                //Frees results and closes the connection to the database.
                $stmt->close();
                $db->close();
            } else {
                //Give error if current password does not match.
                $errors .= "Error: Current Password does not match";
            }
        }

        //Query to get user information.
        $query = "SELECT username, name, email, sharing FROM members "
                . "WHERE user_id = " . $_SESSION['valid_user'] . " LIMIT 1";
        $result = db_select($query);
        $userdetails = mysqli_fetch_assoc($result);
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
            //Create form to resubmit to this page; edit all of the user's fields.
            ?>
            <h1>Edit User Details</h1>
            <?php
            if (isset($edited)) echo "<span style='color: #479b61;'>Success! Your account has been updated.</span>";
            if (isset($errors)) echo "<span style='color: #eb9437;'>" . $errors . "</span>";
            
            ?>
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method='POST'>
                <table width ='100%'>
                    <tr>
                        <th>Username</th>
                        <td><input type="text" name="username" value='<?= $userdetails['username'] ?>'></td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td><input type="text" name="name" value='<?= $userdetails['name'] ?>'></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><input type="text" name="email" value='<?= $userdetails['email'] ?>'></td>
                    </tr>
                    <tr>
                        <th>Sharing</th>
                        <td>
                            <select name='sharing'>
                                <option value='1' <?php
                                if ($userdetails['sharing'] == 1) echo 'selected';
                                ?>>Yes</option>
                                <option value='0' <?php
                                if ($userdetails['sharing'] == 0) echo 'selected';
                                ?>>No</option>
                            </select>
                        </td>
                    <tr>
                        <th>Current Password</th>
                        <td><input type="password" name="password"></td>
                    </tr>
                    <tr>
                        <th></th>
                    </tr>
                    <tr>
                        <th>Change Your Password (Optional)</th>
                    </tr>
                    <tr>
                        <th>New Password</th>
                        <td><input type="password" name="new_password"></td>
                    </tr>
                    <tr>
                        <th>Confirm New Password</th>
                        <td><input type="password" name="confirm_password"></td>
                    </tr>
                    <tr>
                        <th></th>
                        <td><input type="submit" value="Save Changes"></td>
                    </tr>
                </table>
            </form>
            <?php
            //Adds the footer.
            require('includes/footer.php');
            ?>
        </body>
        <?php
    }
    ?>
</html>

