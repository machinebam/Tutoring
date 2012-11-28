<?php

function openCheeseDb() {

    $conn = mysqli_connect('localhost', 'root', 'root', 'cheese_shop', '8889');
    if (!$conn) {
        die('Could not connect to MySQL: ' . mysqli_connect_error());
    }
    mysqli_query($conn, 'SET NAMES \'utf8\'');

    return $conn;
}

?>