<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Database</title>
    </head>
    <body>
        <?php
      $conn = mysqli_connect('localhost', 'root', '', 'cdcol?zeroDateTimeBehavior=convertToNull', '3306');
      if (!$conn) {
          die('Could not connect to MySQL: ' . mysqli_connect_error());
      }
      mysqli_query($conn, 'SET NAMES \'utf8\'');

      echo '<table>';
      echo '<tr>';
      echo '<th>titel</th>';
      echo '<th>interpret</th>';
      echo '<th>jahr</th>';
      echo '</tr>';
      $result = mysqli_query($conn, 'SELECT titel, interpret, jahr FROM cds');
      while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != NULL) {
          echo '<tr>';
          echo '<td>' . $row['titel'] . '</td>';
          echo '<td>' . $row['interpret'] . '</td>';
          echo '<td>' . $row['jahr'] . '</td>';
          echo '</tr>';
      }
      mysqli_free_result($result);
      echo '</table>';
      
      mysqli_close($conn);
        ?>
    </body>
</html>