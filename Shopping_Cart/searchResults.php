<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Seach Results</title>
    </head>
    <body>
        <h1>Search Results</h1>


        <?php
        if (array_key_exists('q', $_GET)) {


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
                FROM items
                    WHERE item_name
                        LIKE '% cheese %'
        
                OR item_description
                        LIKE '%  cheese %'

                    ";

            $result = mysqli_query($conn, $query);


            while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != NULL) 
                
                {
                echo '<tr>';

                echo '<td>' . $row['item_name'] . '</td>';


                echo '<td>' . $row['unit_price'] . '</td>';
                echo '<td>' . $row['picture_file_name'] . '</td>';
                echo '</tr>';
            }
        } else {

            print "No results available";
        }
        ?>






        <!-- google code-->
    </body>
</html>
