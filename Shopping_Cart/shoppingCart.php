
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $conn = mysqli_connect('localhost', 'root', '', 'cheese_shop', '3306');
if (!$conn) {
    die('Could not connect to MySQL: ' . mysqli_connect_error());
}
mysqli_query($conn, 'SET NAMES \'utf8\'');


echo '<table>';
echo '<tr>';
echo '<th>id</th>';
echo '<th>order_id</th>';
echo '<th>item_id</th>';
echo '</tr>';
$result = mysqli_query($conn, 'SELECT id, order_id, item_id FROM items_orders');
while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != NULL) {
    echo '<tr>';
    echo '<td>' . $row['id'] . '</td>';
    echo '<td>' . $row['order_id'] . '</td>';
    echo '<td>' . $row['item_id'] . '</td>';
    echo '</tr>';
}
mysqli_free_result($result);
echo '</table>';


mysqli_close($conn);
        ?>
    </body>
</html>
