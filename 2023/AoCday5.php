<?php

$inputData = explode("\n\n", file_get_contents('inputday5test.txt'));

$lowestLocationNumber = 0;
$locations = array();

$seeds = explode(" ", trim(array_shift($inputData), "seeds: "));

foreach($seeds as $seed) {
    
    $destination = getDestination($seed, createMapping($inputData[0]));
    $destination = getDestination($destination, createMapping($inputData[1]));
    $destination = getDestination($destination, createMapping($inputData[2]));
    $destination = getDestination($destination, createMapping($inputData[3]));
    $destination = getDestination($destination, createMapping($inputData[4]));
    $destination = getDestination($destination, createMapping($inputData[5]));
    $destination = getDestination($destination, createMapping($inputData[6]));

    $locations[] = $destination;
}

sort($locations);

echo "PART 1: Lowest location number " . array_shift($locations) . PHP_EOL;

function createMapping($input) {

    $map = array();

    $inputLines = explode("\n", $input);
    array_shift($inputLines);

    foreach($inputLines as $range) {
        $range = explode(" ", $range);
        $map[] = array("destination" => $range[0], "source" => $range[1], "length" => $range[2]);
    }

    return $map;
}

function getDestination($source, $mapping) {

    $destination = $source;

    foreach($mapping as $range) {
        if(
            $source >= $range['source'] && 
            $source < $range['source'] + $range['length']) 
        {
            $destination = $range['destination'] + ($source - $range['source']);
        }
    }

    return (int)$destination;
}

?>