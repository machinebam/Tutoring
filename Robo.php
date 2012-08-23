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
      
        include_once 'Robot.php';
        
$robot1 = new Robot;
$robot1->colour = "Red";
$robot1->name = "Optimus Prime";

$robot2 = new Robot;
$robot2->colour = "Grey";
$robot2->name = "Megatron";

$robot1->dance();
$robot2->dance();
        
        ?>
    </body>
</html>
