<?php

/* Code belonging with https://adventofcode.com/2021/day/9 */

// Reading input file
$inputData = explode("\n", file_get_contents('inputday9.txt'));
$map = $lowpoints = array();
$sumRiskLevels = 0;

$maxWidth = strlen($inputData[0]);
$maxHeight = sizeof($inputData);

foreach($inputData as $line) {
    $map[] = str_split($line);
}

foreach($map as $lineKey => $line) {
    foreach($line as $posKey => $position) {
        if(isLowPoint($position, $posKey, $lineKey, $map, $maxWidth, $maxHeight)) {
            $lowpoints[] = $position;
        }
    }
}

foreach($lowpoints as $point) {
    $sumRiskLevels += $point + 1;
}

print_r("Sum risk levels: " . $sumRiskLevels . PHP_EOL);

function isLowPoint($position, $posKey, $lineKey, $map, $maxWidth, $maxHeight) {

    // Number before
    if($posKey - 1 >= 0 && $map[$lineKey][$posKey-1] <= $position) { return false; }
    // Number after
    if($posKey + 1 < $maxWidth && $map[$lineKey][$posKey+1] <= $position) { return false; }
    // Number above
    if($lineKey - 1 >= 0 && $map[$lineKey-1][$posKey] <= $position) { return false; }
    // Number below
    if($lineKey + 1 < $maxHeight && $map[$lineKey+1][$posKey] <= $position) { return false; }

    return true;
 }

?>