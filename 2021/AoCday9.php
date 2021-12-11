<?php

/* Code belonging with https://adventofcode.com/2021/day/9 */

// Reading input file
$inputData = explode("\n", file_get_contents('inputday9.txt'));
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
    $result = getBassinPoints($lowpoint, $map, $maxWidth, $maxHeight);
    $result = array_unique($result);

    $bassins[] = sizeof($result);
}

rsort($bassins);

print_r("Size:" . ($bassins[0] * $bassins[1] * $bassins[2]) . PHP_EOL);


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

    $neighbours = $returnList = $newPoints = array();

    $curValue = $map[$point[0]][$point[1]];

    $returnList[] = implode(",", $point);

    $neighbours = getNeighbours($point[0], $point[1]);

    foreach($neighbours as $neighbourPoint) {
        
        if(
            ($neighbourPoint[0] < 0 || $neighbourPoint[0] >= $maxHeight) ||
            ($neighbourPoint[1] < 0 || $neighbourPoint[1] >= $maxWidth)
        ) {
            continue;
        }

        if(
            $map[$neighbourPoint[0]][$neighbourPoint[1]] >= 9 || 
            $map[$neighbourPoint[0]][$neighbourPoint[1]] < $curValue
        ) {
            continue;
        }

        $newPoints[] = $neighbourPoint;
    }

    if(sizeof($newPoints)) {
        foreach($newPoints as $newPoint) {
            $returnList[] = implode(",", $newPoint);
            $returnList2 = getBassinPoints($newPoint, $map, $maxWidth, $maxHeight);
            $returnList = array_merge($returnList, $returnList2);
        }
    }

    return $returnList;
}

function getNeighbours($lineKey, $posKey) {
    
    $one = array(($lineKey - 1), $posKey);
    $two = array(($lineKey + 1), $posKey);
    $three = array($lineKey, ($posKey - 1));
    $four = array($lineKey, ($posKey + 1));
    $neighbours = array($one, $two, $three, $four);
    
    return $neighbours;
}

?>