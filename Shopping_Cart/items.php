<?php

session_start();

$cartCount = -0; //number of items in cart

if (array_key_exists('cartCount', $_SESSION)){
    
    $cartCount = $_SESSION ['cartCount'];
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Cheese Shop</title>
        
        <style type="text/css">
            body{
                
             background-color: bisque;
             color: black;
             font-family: monospace;
             font-size: 1.5em;
            }
            
            table {
                
                background-color: #ff9966;
                border: solid brown;
            }
            
            th {
                
                background-color: crimson;
                text-transform: uppercase;
                
            }
            
        </style> 
        
      
    </head>
    <body>
        
        <?php
        
        print $cartCount;
        
        ?>
        Items in your 
        
        <a href="shoppingCart.php">Shopping Cart</a>

        
<table>
<tr>
    
    <th>item name</th>
    <th>item desciption</th>
    <th>unit price</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
</tr>


<?php
require_once 'dbfunctions.php';



$conn = openCheeseDb(); //from dbfunctions.php

$result = mysqli_query($conn, 'SELECT id, item_name, item_desciption, unit_price, picture_file_name FROM items');
while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != NULL) {
    echo '<tr>';
    $itemID = $row['id'];
    
    
    echo '<td>' . $row['item_name'] . '</td>';
    echo '<td>' . $row['item_desciption'] . '</td>';
    echo '<td>' . $row['unit_price'] . '</td>';
    echo '<td><img src="Shopping_Cart/thumbnails/' . $row['picture_file_name'] . '"/></td>';
    ?>
    <td>
<form action="addItemToCart.php" method="post">
    <input type="hidden" name="itemID" value="<?php echo $itemID; ?>" />
    <input type="submit" name="addItem" value="Add" />
</form>
    </td>       

<?php
    echo '</tr>';
}
mysqli_free_result($result);
echo '</table>';

mysqli_close($conn);     
        //TODO: Link CSS
        
        
        ?>
    </body>
</html>
