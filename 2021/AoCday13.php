<?php

/* Code belonging with https://adventofcode.com/2021/day/13 */
error_reporting(E_ERROR | E_PARSE);

// Reading input file
$inputData = explode("\n\n", file_get_contents('inputday13.txt'));
$map = explode("\n", $inputData[0]);
$foldList = parseFolds(explode("\n", $inputData[1]));

foreach($foldList as $fold) {

    list($axe, $nr) = explode("=", $fold);

    $map = executeFold($map, $axe, $nr);
    $map = array_unique($map);
}

// Part 1
print_r("Nr dots: " . sizeof($map) . PHP_EOL);

// Part 2
printPaperSheet($map);

function printPaperSheet($map) {

    $maxX = $maxY = 0;
    $mapPoints = array();

    // Get size of the grid and filled points
    foreach($map as $point) {

        list($x, $y) = explode(",", $point);

        $maxX = $x > $maxX ? $x : $maxX;
        $maxY = $y > $maxY ? $y : $maxY;

        $mapPoints[$y][$x] = "#";
    }

    // Print grid
    for($i = 0; $i <= $maxY; $i++) {
        for($j = 0; $j <= $maxX; $j++) {
            print_r($mapPoints[$i][$j] ?: ".");
        }
        print_r(PHP_EOL);
    }

    print_r(PHP_EOL);

    return true;
}

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