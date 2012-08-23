<?php

function square1($number) {
    return $number * $number;
}
$val = square1 ($val);

function square2(&$number) {
    $number = $number * $number;
}

square2 ($val);

?>
