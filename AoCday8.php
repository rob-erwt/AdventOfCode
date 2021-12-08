<?php

/* Code belonging with https://adventofcode.com/2021/day/8 */

// Build info on digits
$digits = array(
    0 => "abcefg",
    1 => "cf",
    2 => "acdeg",
    3 => "acdfg",
    4 => "bcdf",
    5 => "abdfg",
    6 => "abdefg",
    7 => "acf",
    8 => "abcdefg",
    9 => "abcdfg"
);

// Reading input file
$inputData = explode("\n", file_get_contents('inputday8.txt'));
$parsedInput = array();

// Parse input data into datastructure: array("signalPattern" => array(), "digitalOutput" => array())
foreach($inputData as $line) {
    list($signalPattern, $digitOutput) = explode(" | ", $line);

    $parsedInput[] = array(
        'signalPattern' => explode(" ", $signalPattern),
        'digitalOutput' => explode(" ", $digitOutput)
    );
}

// Part 1
$countNumbers = array("1" => 0, "4" => 0, "7" => 0, "8" => 0);

foreach($parsedInput as $line) {
    $digitalOutput = $line['digitalOutput'];

    foreach($digitalOutput as $item) {
        switch (strlen($item)) {
            case strlen($digits[1]):
                $countNumbers[1]++;
                break;
            case strlen($digits[4]):
                $countNumbers[4]++;
                break;
            case strlen($digits[7]):
                $countNumbers[7]++;
                break;
            case strlen($digits[8]):
                $countNumbers[8]++;
                break;
        }
    }
}

print_r("Number of 1, 4, 7 & 8 digits: " . array_sum($countNumbers) . PHP_EOL);

?>