<?php
require_once("Includes/db.php");

/**other variables */
$userNameIsUnique = true;
$passwordIsValid = true;
$userIsEmpty = false;
$passwordIsEmpty = false;
$password2IsEmpty = false;

/** Check that the page was requested from itself via the POST method. */
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    /** Check whether the user has filled in the wisher's name in the text field "user" */
    if ($_POST['user']==""){
        $userIsEmpty = true;
    }

    /** Create database connection */

    $userID = cheeseDB::getInstance()->get_user_id_by_name($_POST['user']);
    if ($userID) {
        $userNameIsUnique = false;
    }

    /** Check whether a password was entered and confirmed correctly */
    if ($_POST['password']=="")
    $passwordIsEmpty = true;
    if ($_POST['password2']=="")
    $password2IsEmpty = true;
    if ($_POST['password']!=$_POST['password2']) {
        $passwordIsValid = false;
    }

    /** Check whether the boolean values show that the input data was validated successfully.
     * If the data was validated successfully, add it as a new entry in the "wishers" database.
     * After adding the new entry, close the connection and redirect the application to editWishList.php.
     */
    if (!$userIsEmpty && $userNameIsUnique && !$passwordIsEmpty && !$password2IsEmpty && $passwordIsValid) {
        cheeseDB::getInstance()->create_user($_POST['user'], $_POST['password']);
        session_start();
        $_SESSION['user'] = $_POST['user'];
        header('Location: editWishList.php' );
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
   <head>
    <meta charset="utf-8">
    <title>Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 20px;
        padding-bottom: 40px;
      }

      /* Custom container */
      .container-narrow {
        margin: 0 auto;
        max-width: 700px;
      }
      .container-narrow > hr {
        margin: 30px 0;
      }

      /* Main marketing message and sign up button */
      .jumbotron {
        margin: 60px 0;
        text-align: center;
      }
      .jumbotron h1 {
        font-size: 72px;
        line-height: 1;
      }
      .jumbotron .btn {
        font-size: 21px;
        padding: 14px 24px;
      }

      /* Supporting marketing content */
      .marketing {
        margin: 60px 0;
      }
      .marketing p + h4 {
        margin-top: 28px;
      }
    </style>
    <link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="shortcut icon" href="../assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
  </head>
    <body>
        
        
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="items.php">Cheese Shop</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="items.php">Home</a></li>
              <li><a href="">About</a></li>
              <li><a href="#contact">Contact</a></li>
              <li><?php
        
        print $cartCount;
        
        ?>
        items in your 
        
        <a href="shoppingCart.php">Shopping Cart</a></li>
              
            <form class="navbar-form pull-right">
              <input class="span2" type="text" placeholder="Email">
              <input class="span2" type="password" placeholder="Password">
              <button type="submit" class="btn">Sign in</button>
            </form>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
        
        <div class="jumbotron"><h1>Register</h1>
            <h2></h2>
        <form class="form-inline" action="createNewUser.php" method="POST">
            Your name: <input type="text" placeholder="Makeup a user name"name="user"/></br>
            <?php
                                            /** Display error messages if "user" field is empty or there is already a user with that name*/
            if ($userIsEmpty) {
                echo ("Enter your name, please!");
                echo ("<br/>");
            }
            if (!$userNameIsUnique) {
                echo ("The person already exists. Please check the spelling and try again");
                echo ("<br/>");
            }
            ?>
            Password: <input type="password" name="password"/>
            <?php
                         /** Display error messages if the "password" field is empty */
            if ($passwordIsEmpty) {
                echo ("Enter the password, please");
                echo ("<br/>");
            }
            ?>
            </br>
            Confirm Password: <input type="password" name="password2"/>
           
            </br>
            </br>
            </br>
            <button type="submit" class="btn btn-large btn-success">
  <!--<i class="btn btn-large btn-success"></i>--> Register
</button    >
            <?php
                         /** Display error messages if the "password2" field is empty
                          * or its contents do not match the "password" field
                         */
            if ($password2IsEmpty) {
                echo ("Confirm your password, please");
                echo ("<br/>");
            }
            if (!$password2IsEmpty && !$passwordIsValid) {
                echo ("<div>The passwords do not match!</div>");
                echo ("<br/>");
            }
            ?>

        </form>
            
        </div>
        <hr>
        </div>
        

    </body>
</html>