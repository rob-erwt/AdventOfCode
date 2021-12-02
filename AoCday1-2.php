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

/* Code belonging with https://adventofcode.com/2021/day/1 */

$lines = $slidingTotal = array();
$prevLine = $increased = 0;

// Reading inout file
$handle = fopen("inputday1.txt", "r");
if ($handle) {
    while (($line = fgets($handle)) !== false)
        $lines[] = $line;

    fclose($handle);
} else {
    echo "Error opening file!\n";
} 

// Test case
//$lines = array(199,200,208,210,200,207,240,269,260,263);

// Create the sliding three measurement: pick current value and the next two.
for($idx = 0; $idx < sizeof($lines); $idx++) {
    
    // If we don't ave 3 new values, we are done. So break te cycle. :)
    if(sizeof($lines) <= ($idx + 2))
        break;

    $slidingTotal[$idx] = $lines[$idx] + $lines[$idx + 1] + $lines[$idx + 2];
}

// Check if the current three measurement value is bigger then the previous
foreach($slidingTotal as $current){

    if($prevLine > 0 && $current > $prevLine)
        $increased++;

    $prevLine = $current;
}

print_r($increased . "\n");

?>