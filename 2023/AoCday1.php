<?php

$calibrationSum = 0;
$inputData = explode("\n", file_get_contents('inputday1.txt'));

foreach($inputData as $line) {

    $filteredNumbers = array();

    $chars = str_split($line);
    foreach($chars as $char) {
        if(is_numeric($char)){
            $filteredNumbers[] = $char;
        }
    }
    
    reset($filteredNumbers);
    $calibrationSum += current($filteredNumbers).end($filteredNumbers);
}

echo "PART 1: Sum all calibrations: " . $calibrationSum . PHP_EOL;

//echo "PART 2: Top 3 total: " . array_sum(array_slice($totals, 0, 3)) . PHP_EOL;

?>