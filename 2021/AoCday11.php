<?php

/* Code belonging with https://adventofcode.com/2021/day/11 */

// Reading input file
$inputData = explode("\n", file_get_contents('inputday11.txt'));
$map = array();

// Convert input into single dimensional associative array
for($h = 0; $h < sizeof($inputData); $h++) {

    $line = str_split($inputData[$h]);

    for($w = 0; $w < sizeof($line); $w++) {
        $map[$h . "," . $w] = $line[$w];
    }
}

$nrLoops = 100;
$nrFlashes = 0;

while($nrLoops) {

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

    $nrLoops--;
}

print_r("Nr flashes: " . $nrFlashes . PHP_EOL);

?>