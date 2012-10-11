<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // Validating Data and Adding It to the Database
        //Initialize variables. The first variables pass database credentials, 
        //others variables that will be used in the PHP operations.

        /** database connection credentials */
        $dbHost = "localhost"; //on MySql
        $dbXeHost = "localhost/XE";
        $dbUsername = "phpuser";
        $dbPassword = "phpuserpw";

        /** other variables */
        $userNameIsUnique = true;
        $passwordIsValid = true;
        $userIsEmpty = false;
        $passwordIsEmpty = false;
        $password2IsEmpty = false;
        /** Check that the page was requested from itself via the POST method. */
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            /** Check whether the user has filled in the wisher's name in the text field "user" */
            if ($_POST['user'] == "") {
                $userIsEmpty = true;
            }

            /** Create database connection */
            $con = mysqli_connect("localhost", "phpuser", "phpuserpw");
            if (!$con) {
                exit('Connect Error (' . mysqli_connect_errno() . ') '
                        . mysqli_connect_error());
            }
            //set the default client character set 
            mysqli_set_charset($con, 'utf-8');

            /** Check whether a user whose name matches the "user" field already exists */
            mysqli_select_db($con, "wishlist");
            $user = mysqli_real_escape_string($con, $_POST['user']);
            $wisher = mysqli_query($con, "SELECT id FROM wishers WHERE name='" . $user . "'");
            $wisherIDnum = mysqli_num_rows($wisher);
            if ($wisherIDnum) {
                $userNameIsUnique = false;
            }

            if ($_POST["password"] == "") {
                $passwordIsEmpty = true;
            }
            if ($_POST["password2"] == "") {
                $password2IsEmpty = true;
            }
            if ($_POST["password"] != $_POST["password2"]) {
                $passwordIsValid = false;
            }
            /** Check whether the boolean values show that the input data was validated successfully.
             * If the data was validated successfully, add it as a new entry in the "wishers" database.
             * After adding the new entry, close the connection and redirect the application to editWishList.php.
             */
            if (!$userIsEmpty && $userNameIsUnique && !$passwordIsEmpty && !$password2IsEmpty && $passwordIsValid) {
                $password = mysqli_real_escape_string($con, $_POST['password']);
                mysqli_select_db($con, "wishlist");
                mysqli_query($con, "INSERT wishers (name, password) VALUES ('" . $user . "', '" . $password . "')");
                mysqli_free_result($wisher);
                mysqli_close($con);
                header('Location: editWishList.php');
                exit;
            }
        }
        ?>
        <!-- Form to enter a new wish-->

        Welcome!<br>
        <form action="createNewWisher.php" method="POST">
            Your name: <input type="text" name="user"/><br/>



            <?php
            if ($userIsEmpty) {
                echo ("Enter your name, please!");
                echo ("<br/>");
            }
            if (!$userNameIsUnique) {
                echo ("The person already exists. Please check the spelling and try again");
                echo ("<br/>");
            }
            ?> 
            Password: <input type="password" name="password"/><br/>



            <?php
            if ($passwordIsEmpty) {
                echo ("Enter the password, please!");
                echo ("<br/>");
            }
            ?>
            Please confirm your password: <input type="password" name="password2"/><br/>
            <?php
            if ($password2IsEmpty) {
                echo ("Confirm your password, please");
                echo ("<br/>");
            }
            if (!$password2IsEmpty && !$passwordIsValid) {
                echo ("The passwords do not match!");
                echo ("<br/>");
            }
            ?>

            <input type="submit" value="Register"/>
        </form>

    </body>
</html>
