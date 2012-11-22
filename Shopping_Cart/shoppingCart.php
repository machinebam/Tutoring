<?php

session_start();
$orderID = -1;

if (array_key_exists('orderID', $_SESSION)) {
    
    $orderID = $_SESSION['orderID'];
    
}else {
    
    header ('Location: items.php'); //redirect user back the iems.php
}

//we now have an $orderID that we can use as the users shopping cart
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        
        <a href="items.php">Go Back</a></br>
        <?php
        $conn = mysqli_connect('localhost', 'root', '', 'cheese_shop', '3306');
if (!$conn) {
    die('Could not connect to MySQL: ' . mysqli_connect_error());
}
mysqli_query($conn, 'SET NAMES \'utf8\'');


echo '<table>';
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

$result = mysqli_query($conn, $query );

$total = 0;
while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != NULL) {
    echo '<tr>';
   
    echo '<td>' . $row['item_name'] . '</td>';
    
    
    echo '<td>' . $row['unit_price'] . '</td>';
     echo '<td>' . $row['picture_file_name'] . '</td>';
    echo '</tr>';
    
    $total = $total + $row['unit_price'];
    
}
mysqli_free_result($result);

echo '<tr><td>TOTAL</td><td>' .$total . '</td><td>&nbsp; </td>';
echo '</table>';


mysqli_close($conn);
        ?>
    </body>
</html>
