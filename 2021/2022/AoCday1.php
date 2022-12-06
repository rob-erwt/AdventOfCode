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

$totals = array();
$idx = 0;

$totals[$idx] = 0;
$inputData = explode("\n", file_get_contents('inputday1.txt'));

foreach($inputData as $line) {
    if($line) {
        $totals[$idx] += $line;
    }
    else {
        $idx++;
        $totals[$idx] = 0;
    }
}

rsort($totals);

echo "PART 1: Most calories: " . $totals[0] . PHP_EOL;

echo "PART 2: Top 3 total: " . array_sum(array_slice($totals, 0, 3)) . PHP_EOL;

?>