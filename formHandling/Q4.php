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
        // arry to contain afl clubs and coaches surnames

        $afl = array('Adelaide' => 'Sanderson',
            'Brisbane Lions' => 'Voss',
            'Carlton' => 'Ratten',
            'Collingwood' => 'Buckley',
            'Essendon' => 'Hird',
            'Fremantle' => 'Lyon',
            'Geelong'=> 'Scott',
            'Gold Coast' => 'McKenna',
            'Greater Western Sydney' => 'Sheedy',
            'Hawthorn' => 'Clarkson',
            'Melbourne' => 'Neeld',
            'North Melbourne' => 'Scott',
            'Port Adelaide' => 'Primus',
            'Richmond' => 'Hardwick',
            'St Kilda' => 'Watters',
            'Sydney Swans' => 'Longmire',
            'West Coast Eagles' => 'Worsfold',
            'Western Bulldogs' => 'McCartney');


        //remove the value "Sheedy" from the array (and its associated key)

        unset($afl['Greater Western Sydney']);


        //loop to print out each iteam in the arry       
        foreach ($afl as $key => $value) {


            print "The coach of $key is $value.<br>\n";
        }

        print "<br>\n";



        //If test to add John to coaches names 'Longmire' or 'Worsfold'


        foreach ($afl as $key => $value) {

            if ($value == "Worsfold") {

                print "The coach of $key is John $value.<br>\n";
            } else if ($value == "Longmire") {

                print "The coach of $key is John $value.<br>\n";
            } else {

                print "The coach of $key is  $value.<br>\n";
            }
        }


        //Football Clubs in Numbered List

        print "<ol>";

        foreach ($afl as $key => $value) {


            print "<li>The coach of $key is $value.</li>";
        }

        print"</ol>";

        print"<br>\n";


        //Retreive the St Kilda coach


        print $afl['St Kilda'];
        
        print "<br>\n";

        //Search for the first club that "Scott" coaches and print
        
     

$key = array_search('Scott', $afl);


print "$key";


        
        
        ?>
    </body>
</html>
