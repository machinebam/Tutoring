<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <style type= "text/css">
            html body {
                float: left;
                color: white;
                background: #006600;
                font-family: cursive;
                font-size: 2em;

            }   

            form {
                float:right;
                width: 60%;
                margin-right:1em;


            }

        </style>
    </head>
    <body>


        <?php
        /* put your code here PHP Control Structures Ex.
         *  #1: If-Else Statement
         */

        if (empty($_POST)) {
            print "What is your name.<br\>";
        } else {
            print "Welcome " . $_POST['firstName'] . " " . $_POST['lastName'];
        }

        $month = date('F', time());


        if ($month == 'December') {
            print "<p>Merry Christmas!</p>";
        } else {
            print "<p>It's $month</p>";
        }
        echo "<p>\n";

        $counter = 1;
        while ($counter < 10) {
            echo 'Hello ';
            $counter++;
        }

        echo "</p>\n";
        echo "<p>\n";

        $counter = 1;
        do {
            echo 'World! ';
            $counter++;
        } while ($counter < 5);

        echo "</p>\n";

        for ($x = 1; $x < 10; $x++) {
            echo "$x ";
        }
        ?>

        <form action="examples.php" method="POST">
            <label for="firstName">First Name</label>
            <input id="firstName" type="text" name="firstName" value="" />
            </br>

            <label for="firstName">Last Name</label>
            <input id="lastName" type="text" name="lastName" value="" />

            <label for="Subscribe"><br/>Subscribe</label>
            <input id="Subscribe"type="checkbox" name="Month" value="ON" />

            <select name="month">
                <option value="Jan">January</option>
                <option value="Feb">February</option>
                <option value="Jan">March</option>
                <option value="Feb">April</option>


                <input type="submit" value="Go" name="Submit" />
            </select>
        </form>
    </body>
</html>
