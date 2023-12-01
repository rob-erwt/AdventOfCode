<?php

$calibrationSumPt1 = $calibrationSumPt2 = 0;
$inputData = explode("\n", file_get_contents('inputday1.txt'));

foreach($inputData as $line) {

    // PART 1
    $filteredNumbers = array();

    $chars = str_split($line);
    foreach($chars as $char) {
        if(is_numeric($char)){
            $filteredNumbers[] = $char;
        }
    }
    
    reset($filteredNumbers);
    $calibrationSumPt1 += current($filteredNumbers).end($filteredNumbers);

    // PART 2
    $parsedLine = str_replace(
                    array("one", "two", "three", "four", "five", "six", "seven", "eight", "nine"),
                    array("one1one", "two2two", "three3three", "four4four", "five5five", "six6six", "seven7seven", "eight8eight", "nine9nine"),
                    $line);

    $filteredNumbers = array();

    $chars = str_split($parsedLine);
    foreach($chars as $char) {
        if(is_numeric($char)){
            $filteredNumbers[] = $char;
        }
    }
    
    reset($filteredNumbers);
    $calibrationSumPt2 += current($filteredNumbers).end($filteredNumbers);

}

echo "PART 1: Sum all calibrations: " . $calibrationSumPt1 . PHP_EOL;

echo "PART 2: Sum all calibrations: " . $calibrationSumPt2 . PHP_EOL;

?>