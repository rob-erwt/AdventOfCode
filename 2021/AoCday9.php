<?php

/* Code belonging with https://adventofcode.com/2021/day/9 */

// Reading input file
$inputData = explode("\n", file_get_contents('inputday9test.txt'));
$map = $lowpoints = $lowpointBassins = $bassins = array();
$sumRiskLevels = 0;

$maxWidth = strlen($inputData[0]);
$maxHeight = sizeof($inputData);

foreach($inputData as $line) {
    $map[] = str_split($line);
}

// Part 1
foreach($map as $lineKey => $line) {
    foreach($line as $posKey => $position) {
        if(isLowPoint($position, $posKey, $lineKey, $map, $maxWidth, $maxHeight)) {
            $lowpoints[] = $position;
            $lowpointBassins[] = array($lineKey, $posKey);
        }
    }
}

foreach($lowpoints as $point) {
    $sumRiskLevels += $point + 1;
}

print_r("Sum risk levels: " . $sumRiskLevels . PHP_EOL);

// Part 2
foreach($lowpointBassins as $lowpoint)
{
    $bassins[] = getBassinPoints($lowpoint, $map, $maxWidth, $maxHeight);
}

var_dump($bassins);

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

function getBassinPoints($point, $map, $maxWidth, $maxHeight) {

    $neighbours = $newNeighbours = $newPoints = array();

    $bassinPoints[] = $point;
    $curValue = $map[$point[0]][$point[1]];
    
    $neighbours = getNeighbours($point[0], $point[1], $maxWidth, $maxHeight);

    if(sizeof($neighbours)) {
        foreach($neighbours as $neighbourPoint) {
            if(
                $map[$neighbourPoint[0]][$neighbourPoint[1]] < 9 &&
                $map[$neighbourPoint[0]][$neighbourPoint[1]] >= $curValue
            ) {
                $newPoints[] = $neighbourPoint;
                $bassinPoints[] = $neighbourPoint;
            }
        }

        if(sizeof($newPoints)) {
            foreach($newPoints as $newPoint) {
                $newNeighbours = getBassinPoints($newPoint, $map, $maxWidth, $maxHeight);
            }
        }
    }

    return array_merge($bassinPoints, $newNeighbours);
}

function getNeighbours($posKey, $lineKey, $maxWidth, $maxHeight) {
    
    if($posKey - 1 >= 0 && $posKey + 1 < $maxWidth && $lineKey - 1 >= 0 && $lineKey + 1 < $maxHeight) {
    
        $neighbours = array(
                array(($lineKey - 1), $posKey),
                array(($lineKey + 1), $posKey),
                array($lineKey, ($posKey - 1)),
                array($lineKey, ($posKey + 1))
            );
        
        return $neighbours;
    }

    return array();
}

?>