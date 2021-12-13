<?php

/* Code belonging with https://adventofcode.com/2021/day/13 */

// Reading input file
$inputData = explode("\n\n", file_get_contents('inputday13.txt'));
$map = explode("\n", $inputData[0]);
$foldList = parseFolds(explode("\n", $inputData[1]));

foreach($foldList as $fold) {

    list($axe, $nr) = explode("=", $fold);

    $map = executeFold($map, $axe, $nr);
    $map = array_unique($map);
}

print_r("Nr dots: " . sizeof($map) . PHP_EOL);

function executeFold($map, $axe, $nr) {

    $newMap = array();

    foreach($map as $point) {

        list($x, $y) = explode(",", $point);
        if($axe == "x" && $x > $nr) {
            $x = $nr - ($x - $nr);
        }

        if($axe == "y" && $y > $nr) {
            $y = $nr - ($y - $nr);
        }

        $newMap[] = $x . "," . $y;
    }

    return $newMap;
}

function parseFolds($strings) {

    $return = $parsed = array();

    foreach($strings as $string) {

        $parsed[] = substr($string, 11);
    }
    
    return $parsed;
}

?>