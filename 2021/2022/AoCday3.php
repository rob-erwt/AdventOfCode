<?php

$inputData = explode("\n", file_get_contents('inputday3.txt'));
$charList = array_merge(range('a', 'z'), range('A','Z'));
$wrongItemsSum = 0;

// PART 1
foreach($inputData as $rucksack) {
    
    $wrongItemsSum += getWrongItemSum($rucksack, $charList);
}

echo "Part 1: Sum wrong items: " . $wrongItemsSum . PHP_EOL;

// PART 2
$rucksackArray = array_chunk($inputData, 3);
$commonValueSum = 0;

foreach($rucksackArray as $rucksack) {

    $commonValueSum += getCommonItemSum($rucksack, $charList);
}

echo "Part 2: Sum common items: " . $commonValueSum . PHP_EOL;


function getWrongItemSum($rucksack, $charList) {

    $wrongItemsSum = 0;

    list($firstCompartment, $secondCompartment) = str_split($rucksack, (strlen($rucksack)/2));

    $wrongItems = array_unique(array_intersect(str_split($firstCompartment), str_split($secondCompartment)));

    foreach($wrongItems as $item) {
        $wrongItemsSum += (array_search($item, $charList) + 1);
    }

    return $wrongItemsSum;
}

function getCommonItemSum($rucksack, $charList) {

    $commonValueSum = 0;
    $commonItems = array_unique(array_intersect(str_split($rucksack[0]), str_split($rucksack[1]), str_split($rucksack[2])));

    foreach($commonItems as $item) {
        $commonValueSum += (array_search($item, $charList) + 1);
    }

    return $commonValueSum;
}

?>