<?php
$val =5;
function square1($number) {
    return $number * $number;
}

$val2 = square1($val);
print "after square1, val is $val <br/>\n";

function square2(&$number) {
    $number = $number * $number;
}

square2($val);
print "after square2, val is $val <br/>\n";
?>
