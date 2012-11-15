        <?php
        
      function openCheeseDb(){  
        
  $conn = mysqli_connect('localhost', 'root', '', 'cheese_shop', '3306');
if (!$conn) {
    die('Could not connect to MySQL: ' . mysqli_connect_error());
}
mysqli_query($conn, 'SET NAMES \'utf8\'');

return $conn;

      }
?>