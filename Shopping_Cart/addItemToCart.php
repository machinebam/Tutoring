<?php

$itemID = $_POST['itemID'];

print "You added $itemID to your cart";

//TODO: check weather the user is logged in. Use $_SESSION
session_start();

require_once 'dbfunctions.php';

$conn = openCheeseDb(); //from dbfunctions.php


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

    $result = $$mysqli_query($conn, 'INSERT INTO cheese_shop.users (full_name) VALUES (NULL)');

    if ($result === false) {

        die("Illegal state: could not insert new record");

        //if we get here we just inserted a new user

        $userID = mysqli_insert_id($conn);
    }
}
//TODO: if user us not logged in, create new user,
// check weather the user hsa an order record with 
//      order_state = 'OPEN' (i.e a shopping cart).
//  

$result = $mysqli_query($conn, "SELECT id FROM orders WHERE order_state = 'OPEN' AND user_id = . $userID");

//TODO: explicitly check that there is only one record.


while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != NULL) {

    $orderID = $row['id'];
}

if ($orderID !== -1) {

    //      if so, add the item to that order record.     
} else {
    //      If not, create a new order record.
//         
$result = $mysqli_query($conn, 
        "INSERT INTO `orders` (`order_state`,`order_total_value`,`user_id`) VALUES('OPEN',NULL,1)");

    if ($result === false) {

        die("Illegal state: could not insert new order");

        //if we get here we just inserted a new order

        $userID = mysqli_insert_id($conn);
    
    
}
}
//we have vaild order to add an item to

$result = $mysqli_query($conn, 
        "INSERT INTO `items_orders` (`order_id`,`item_id`) VALUES($orderID,$itemID)");

    if ($result === false) {

        die("Illegal state: could not insert new order");

        //if we get here we just inserted a new order

        $userID = mysqli_insert_id($conn);
    
    
}
//strore session, 

$_SESSION['userID'] = $userID;
$_SESSION ['orderID'] = $orderID;


header("Location: items.php")

// Add the item to the new order record.

?>
