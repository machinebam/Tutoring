<?php
session_start();
$userID = $_SESSION['userID']; //get the users id

$orderID = -1;

if (array_key_exists('orderID', $_SESSION)) {

    $orderID = $_SESSION['orderID'];
} else {

    header('Location: items.php'); //redirect user back the iems.php
}
require_once 'dbfunctions.php';

$conn = openCheeseDb(); //open connection to database
?>

<?php
$cartCount = -0; //number of items in cart

if (array_key_exists('cartCount', $_SESSION)) {

    $cartCount = $_SESSION ['cartCount'];
}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Order Success</title>
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


                           
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>
    </head>
<body>

    <div class="container">

    <h1 class="jumbotron">Success!</h1>
<?php
// put your code here
echo '<table class="table table-bordered">';
echo '<tr>';
echo '<th>item_name</th>';
echo '<th>unit_price</th>';
echo '<th> </th>';
echo '</tr>';
$query = "SELECT item_id, item_name, unit_price, picture_file_name
FROM items_orders
    INNER JOIN items
        ON items_orders.item_id = items.id

WHERE items_orders.order_id = $orderID";

$result = mysqli_query($conn, $query);

$total = 0;
while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != NULL) {
    echo '<tr class="success">';

    echo '<td>' . $row['item_name'] . '</td>';


    echo '<td>' . $row['unit_price'] . '</td>';
    echo '<td>' . $row['picture_file_name'] . '</td>';
    echo '</tr>';

    $total = $total + $row['unit_price'];
}
mysqli_free_result($result);

echo '<tr><td>TOTAL</td><td>' . $total . '</td><td>&nbsp; </td>';
echo '</table>';
?>

    <h2>Your Details:</h2>

    <?php
    $query2 = "SELECT id, full_name, 
            street_address, city, 
            post_code, country, username, 
            password FROM users
          
WHERE id = $userID";
    $result1 = mysqli_query($conn, $query2);
    while (($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) != NULL) {


        echo "Name: {$row1['full_name']}</br>";
        echo "Address: {$row1['street_address']}</br>";
        echo "City:{$row1['city']}</br>";
        echo "Post Code: {$row1['post_code']}</br>";
        echo "Country: {$row1['country']}</br>";
        echo "Username: {$row1['username']}</br>";
    }
    mysqli_free_result($result1);




    //update the status of the current order

    $query3 = " UPDATE orders 
                    SET order_state = 'SUBMITTED'
                    WHERE id = $orderID";

    $result3 = mysqli_query($conn, $query3);

    if (!$result3) {
        mysqli_query($conn, $query3);
        echo '<br/>There was a problem. <br/>';
    } else { // there was no problem updating the existing order to be SUBMITTED
        $query = "INSERT INTO `orders` (`order_state`,`order_total_value`,`user_id`) VALUES('OPEN',NULL,$userID)";

        $result = mysqli_query($conn, $query);

        if ($result === false) {

            die("Illegal state: could not insert new order");

            //if we get here we just inserted a new order
        }
        $orderID = mysqli_insert_id($conn);

        $_SESSION['orderID'] = $orderID;
        $_SESSION ['cartCount'] = 0;
    }
    ?>
    
    <button class="btn-github"><a href="items.php">Go Again!</a></button>
    </div>
</body>
</html>


<?php
mysqli_close($conn); // close connection
?>