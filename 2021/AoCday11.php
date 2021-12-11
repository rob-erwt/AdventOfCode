<?php

/* Code belonging with https://adventofcode.com/2021/day/11 */

// Reading input file
$inputData = explode("\n", file_get_contents('inputday11.txt'));
$map = $mapPartTwo = array();

// Convert input into single dimensional associative array
for($h = 0; $h < sizeof($inputData); $h++) {

    $line = str_split($inputData[$h]);

    for($w = 0; $w < sizeof($line); $w++) {
        $map[$h . "," . $w] = $line[$w];
        $mapPartTwo[$h . "," . $w] = $line[$w];
    }
}

// Part 1
$nrLoops = 100;
$nrFlashes = 0;

while($nrLoops) {

    $nrFlashes += calculateNextMap($map);
    $nrLoops--;
}

print_r("Nr flashes: " . $nrFlashes . PHP_EOL);

// Part 2
$nrSteps = 0;
$partTwo = true;

while($partTwo) {
    $nrSteps++;

    calculateNextMap($mapPartTwo);

    if(checkForZeroes($mapPartTwo) == 100) { $partTwo = false; }
}

print_r("Nr steps: " . $nrSteps . PHP_EOL);

function calculateNextMap(&$map) {

    $nrFlashes = 0;
    $flashPositions = array();

    foreach($map as $key => $value)
    {
        $map[$key]++;

        if($map[$key] == 10) { $flashPositions[] = $key; }
    }

    while(sizeof($flashPositions)) {
        
        $curPos = array_shift($flashPositions);
        $map[$curPos] = 0;
        $nrFlashes++;

        // Get all the neigbouring positions
        list($height, $width) = explode(",", $curPos);

        $newKeys = array();

        $newKeys[] = ($height - 1) . "," . ($width - 1);    //lefttop
        $newKeys[] = ($height - 1) . "," . $width;          //top
        $newKeys[] = ($height - 1) . "," . ($width + 1);    //righttop
        $newKeys[] = $height . "," . ($width + 1);          //right
        $newKeys[] = ($height + 1) . "," . ($width + 1);    //rightbottom
        $newKeys[] = ($height + 1) . "," . $width;          //bottom
        $newKeys[] = ($height + 1) . "," . ($width - 1);    //leftbottom
        $newKeys[] = $height . "," . ($width - 1);          //left

        foreach($newKeys as $newKey) {

            // Skip neighbouring point if out of map area
            list($h, $w) = explode(",", $newKey);
            if ($h < 0 || $h > 9 || $w < 0 || $w > 9) { continue; }

            // Skip positions that already flashed
            if($map[$newKey]) {
                $map[$newKey]++;
                if($map[$newKey] == 10) { $flashPositions[] = $newKey; } // Add new flash positions to the list
            }
        }
    }

    return $nrFlashes;
}

function checkForZeroes($map) {

    $nrZeroes = 0;
    
    foreach($map as $key => $value) {
        if(!$value) { $nrZeroes++; }
    }

    return $nrZeroes;
}

?>