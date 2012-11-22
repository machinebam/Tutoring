<?php

$itemID = $_POST['itemID'];

//TODO: check weather the user is logged in. Use $_SESSION
session_start();

require_once 'dbfunctions.php';

$conn = openCheeseDb(); //from dbfunctions.php
//only store a new user record is no user ID in session
$userID = -1;
if (array_key_exists("userID", $_SESSION)) {

    $userID = $_SESSION['userID'];
} else {
    if (array_key_exists("user", $_SESSION)) {

        $username = $_SESSION ['user'];

        //TODO: Get user ID database for current userame

        $result = $mysqli_query($conn, "SELECT id FROM users WHERE username ='" . $username);

        while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != NULL) {

            $userID = $row['id'];
        }

        if ($userID === -1) {

            die("Illegal state: could not find user record for username: " + $username);
        }


        //TODO: use the currently logged-in user
    } else {

        // if user us not logged in, create new user,

        $result = mysqli_query($conn, 'INSERT INTO cheese_shop.users (full_name) VALUES (NULL)');

        if ($result === false) {

            die("Illegal state: could not insert new record");

            //if we get here we just inserted a new user
        }
        $userID = mysqli_insert_id($conn);
    }
}
// check weather the user hsa an order record with 
//      order_state = 'OPEN' (i.e a shopping cart).
//  
$orderID = -1;
if (array_key_exists('orderID', $_SESSION)) {

    $orderID = $_SESSION['orderID'];
} else {
    $query = "SELECT id FROM orders WHERE order_state = 'OPEN' AND user_id = $userID";
    $result = mysqli_query($conn, $query);

    //TODO: explicitly check that there is only one record.


    while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != NULL) {

        $orderID = $row['id'];
    }

    if ($orderID !== -1) {

        //      if so, add the item to that order record.     
    } else {
        //      If not, create a new order record.
        $query = "INSERT INTO `orders` (`order_state`,`order_total_value`,`user_id`) VALUES('OPEN',NULL,$userID)";

        $result = mysqli_query($conn, $query);

        if ($result === false) {

            die("Illegal state: could not insert new order");

            //if we get here we just inserted a new order
        }
        $orderID = mysqli_insert_id($conn);
    }
}
//we have vaild order to add an item to

$result = mysqli_query($conn, "INSERT INTO `items_orders` (`order_id`,`item_id`) VALUES($orderID,$itemID)");

if ($result === false) {

    die("Illegal state: could not insert new order");
}
//strore the user ID and order ID in the session,




$_SESSION['userID'] = $userID;
$_SESSION ['orderID'] = $orderID;


header("Location: items.php")

// Add the item to the new order record.
?>
