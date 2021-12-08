<?php

/* Code belonging with https://adventofcode.com/2021/day/5 */

// Reading input file
$inputData = array_filter(explode("\n", file_get_contents('inputday5.txt')));

// Cheating in filling the array, looked in the test file for highest coordinate... ;)
// Pre-filling to prevent warnings in PHP
$map = array_fill(0, 1000, array_fill(0, 1000, 0));
$nrIntersections = 0;

foreach ($inputData as $line) {
    $set = explode(" -> ", $line);
    list($x1, $y1) = explode(",", $set[0]);
    list($x2, $y2) = explode(",", $set[1]);    

    // PART ONE, horizontal vents
    if($x1 == $x2) {  
        // Get the startpoint of the vent 
        $startY = min(array($y1, $y2));
        $endY = max(array($y1, $y2));

        for($startY; $startY <= $endY; $startY++) {
            $map[$startY][$x1]++;
        }
        continue;
    }

    // PART ONE, vertical vents
    if($y1 == $y2) {
        // Get the startpoint of the vent
        $startX = min(array($x1, $x2));
        $endX = max(array($x1, $x2));

        for($startX; $startX <= $endX; $startX++) {
            $map[$y1][$startX]++;
        }
        continue;
    }

    // PART TWO, diagonal vents
    $xRange = range($x1, $x2);
    $yRange = range($y1, $y2);

    for($idx = 0; $idx < sizeof($xRange); $idx++) {
        $map[$yRange[$idx]][$xRange[$idx]]++;
    }
}

// Get intersections 
foreach($map as $line) {
    foreach($line as $value) {
        if($value >= 2) {
            $nrIntersections++;
        }
    }
}

print_r("Nr intersections: " . $nrIntersections . "\n");

?>