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
        
    $myArray = array("Apples", "Oranges", "Pears");
        $size = count($myArray);
        
        print "There are $size items in the array.</br>\n";
        print "The first item it " . $myArray [0] . "</br>\n";
        print "The first item it " . $myArray [1] . "</br>\n";
        print "The first item it " . $myArray [2] . "</br>\n";
        var_dump($myArray);
        //add some passionfruit
        $myArray[] = "Passionfruit";
        
        
     
    
        ?>
    </body>
</html>
