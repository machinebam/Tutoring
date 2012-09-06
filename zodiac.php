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
        $zodiacs = array("Aries" => "20 March", "Taurus" => "20 April",
            "Gemini" => "21 May", "Cancer" => "21 June",
            "Leo" => "22 July", "Virgo" => "23 August",
            "Libra" => "23 September", "Scorpio" => "23 October",
            "Sagittarius" => "22 November", "Capricorn" => "22 December",
            "Aquarius" => "20 January", "Pisces" => "20 March");


        print "<table>\n";
        foreach ($zodiacs as $key => $value) {
            print "<tr><td>$key</td><td>$value</td></tr>\n";
        }
        print '</table>';
        print"<br/>";


        ksort($zodiacs);
        print "<table>\n";
        foreach ($zodiacs as $key => $value) {
            print "<tr><td>$key</td><td>$value</td></tr>\n";
        }
        print '</table>';
        print"<br/>";
        krsort($zodiacs);
        print "<table>\n";
        foreach ($zodiacs as $key => $value) {
            print "<tr><td>$key</td><td>$value</td></tr>\n";
        }
        print '</table>';


        ?>
    </body>
</html>
