
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title> Looney Database</title>
        
        <style type="text/css">
        
          html body {

                text-align: center;
                color: midnightblue;
                font-family: Georgia;
                background-color: aliceblue;
                font-size: 1.4em;
            }
            
            table {
                
                border: thin solid black;
                
                
            }
            </style>
        
    </head>
    <body>
        <?php
        // put your code here and your mothers phone number


        $conn = mysqli_connect('localhost', 'root', '', 'customers', '3306');
        if (!$conn) {
            die('Could not connect to MySQL: ' . mysqli_connect_error());
        }
        mysqli_query($conn, 'SET NAMES \'utf8\'');
        echo '<table>';
        echo '<tr>';

        echo '<th>First Name</th>';
        echo '<th>Last Name</th>';
        echo '<th>Username</th>';
        echo '</tr>';
        $result = mysqli_query($conn, 'SELECT id, `FIRSTNAME`, `LASTNAME`, `USERNAME` FROM customers');
        while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != NULL) {
            echo '<tr>';

            echo '<td>' . 
                    '<a href =""' . 
                    $row['id'].
                    '">' . 
                    $row['FIRSTNAME'] .
                    '</a>' . 
                    '</td>';
            echo '<td>' . $row['LASTNAME'] . '</td>';
            echo '<td>' . $row['USERNAME'] . '</td>';
            echo '</tr>';
        }
        mysqli_free_result($result);
        echo '</table>';
        mysqli_close($conn);
        
        
        
        
        ?>
    </body>
</html>
