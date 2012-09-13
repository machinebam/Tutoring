<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
        if (empty($_POST)) {
            print "<h1>Add your CD.</h1><br\>";
        } else {
            print "Welcome " . $_POST['Album'] . " " . $_POST['Artist'];
        }

      
        echo "</p>\n";
        echo "<p>\n";

        ?>

       
        <form action="cdDataBase.php" method="POST">
            <label for="firstName">Album</label>
            <input id="firstName" type="text" name="firstName" value="" />
            </br>

            <label for="firstName">Artist</label>
            <input id="lastName" type="text" name="lastName" value="" />
            </br>

            <label for="firstName">Year</label>
            <input id="lastName" type="text" name="lastName" value="" />

            </br>
            <input type="submit" value="Go" name="Submit" />
        </select>
</body>
</html>
