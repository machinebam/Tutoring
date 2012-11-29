<?php

/* array(7) { 
 * ["fullName"]             => string(5) "Scott" 
 * ["streetAddress"]        => string(5) "Perth" 
 * ["city"]                 => string(6) "Mackay" 
 * ["postCode"]             => string(4) "4750" 
 * ["country"]              => string(9) "Australia" 
 * ["username"]             => string(3) "Bam" 
 * ["password"]             => string(3) "bam" }
 * 
 * 
 * 
 * 
 * 
 */

//TODO: redirect if we dont have user ID on session
session_start();
    $userID = $_SESSION['userID']; //get the users id

require_once 'dbfunctions.php';

$conn = openCheeseDb(); //open connection to database

$fullName = $_POST['fullName'];
$streetAddress = $_POST['streetAddress'];
$city = $_POST['city'];
$postCode = $_POST['postCode'];
$country = $_POST['country'];
$username = $_POST['username'];
$password = $_POST['password'];

//saniste information from the users

$fullName = mysqli_real_escape_string($conn, $fullName);
$streetAddress = mysqli_real_escape_string($conn, $streetAddress);
$city = mysqli_real_escape_string($conn, $city);
$postCode = mysqli_real_escape_string($conn, $postCode);
$country = mysqli_real_escape_string($conn, $country);
$username = mysqli_real_escape_string($conn, $username);
$password = mysqli_real_escape_string($conn, $password);

$query = "

    UPDATE users
    SET full_name =     '$fullName',
     street_address =   '$streetAddress',
        city =          '$city',
        post_code =     '$postCode',
        country =       '$country',
        username =      '$username',
password =              '$password'
        WHERE id = $userID";






$querySuccess = mysqli_query($conn, $query );

if (!$querySuccess) {
    //echo $query;
    header('Location: customerDetails.php?error=true');
} else {
    
    header ('Location: confirmOrder.php');
}



mysqli_close($conn); //close the database connection.
?>
