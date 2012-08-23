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
        $newArray = ["a"=>"APPLES"];
        $size = count($myArray);

        print "There are $size items in the array.</br>\n";
        print "The first item is " . $myArray [0] . "</br>\n";
        print "The first item is " . $myArray [1] . "</br>\n";
        print "The first item is " . $myArray [2] . "</br>\n";
        printOutArray($myArray);
        //add some passionfruit
        $myArray[] = "Passionfruit";

        function printOutArray($myArray) {
            print "===================</br>\n";
            foreach ($myArray as $key => $value) {
                print "$key: $value </br>\n";
            }
        }
        ?>
    </body>
</html>
