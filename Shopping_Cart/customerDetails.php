
<?php
session_start();

$cartCount = -0; //number of items in cart

if (array_key_exists('cartCount', $_SESSION)) {

    $cartCount = $_SESSION ['cartCount'];
}
?>



<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Customer Details</title>

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

        <div class="jumbotron"><h1>Customer Details</h1>
            <h2></h2>
        </div>

        <form class="inline"action="storeCustomerDetails.php" method="POST">
            <span class="span3">Full Name:</span><input type="text" name="fullName" value="" /></br>
            <span class="span3">Street Address:</span><input type="text" name="streetAddress" value="" /></br>
            <span class="span3">City:</span><input type="text" name="city" value="" /></br>
            <span class="span3">Postcode:</span><input type="text" name="postCode" value="" size="4" /></br>
            <span class="span3">Country:</span><input type="text" name="country" value="" /></br>
            <span class="span3">Username:</span><input type="text" name="username" value="" /></br>
            <span class="span3">Password:</span><input type="password" name="password" value="" /></br>
            <span class="span3"><input class="btn btn-large btn-success" type="submit" value="next" /></span>
        </form>
        <br/>


<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (array_key_exists('error', $_GET)) {

        if ($_GET['error'] === 'true') {

            print '<span class="error">
                    There was a problem.
                    </span>';
        }
    }
}
?>


    </body>
</html>
