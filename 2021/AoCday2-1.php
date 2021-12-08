<?php

/**
 * Spoilers
 * Spoilers
 * Spoilers
 * Spoilers
 * Spoilers
 * Spoilers
 * Spoilers
 * Spoilers
 * Spoilers
 */

/* Code belonging with https://adventofcode.com/2021/day/2 */

$lines = $movements = array();
$horizontalPosition = $depth = $aim = 0;

// Reading input file
$lines = explode("\n", file_get_contents('inputday2.txt'));
foreach($lines as $line){ 
    if($line)
        $movements[] = explode(" ", $line);
}

// Test case
//$movements = array(['forward', 5], ['down', 5], ['forward', 8], ['up', 3], ['down', 8], ['forward', 2]);

//print_r($movements);

foreach($movements as $movement){
    $direction = $movement[0];
    $distance = $movement[1];

    switch($direction){
        case 'forward':
            $horizontalPosition += $distance;
            $depth += ($aim * $distance);
            break;
        
        case 'up':
            $aim -= $distance;
            break;

        case 'down':
            $aim += $distance;
            break;
    }
}

$final = $horizontalPosition * $depth;

print_r("Hor.: " . $horizontalPosition . ", Depth: " . $depth . ", Total: " . $final . "\n");

?>