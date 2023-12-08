<?php

$inputData = explode("\n\n", file_get_contents('inputday5.txt'));

$locations = array();

$seeds = explode(" ", trim(array_shift($inputData), "seeds: "));

// Part 1
foreach($seeds as $seed) {

    $locations[] = walkMapping($seed, $inputData);
}

sort($locations);

echo "PART 1: Lowest location number " . array_shift($locations) . PHP_EOL;

// Part 2
$location = 0;
//$location = getSeedsRange($seeds, $inputData);

echo "PART 2: Lowest location number " . $location . PHP_EOL;


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

function walkMapping($seed, $inputData) {

    $destination = getDestination($seed, createMapping($inputData[0]));
    $destination = getDestination($destination, createMapping($inputData[1]));
    $destination = getDestination($destination, createMapping($inputData[2]));
    $destination = getDestination($destination, createMapping($inputData[3]));
    $destination = getDestination($destination, createMapping($inputData[4]));
    $destination = getDestination($destination, createMapping($inputData[5]));
    $destination = getDestination($destination, createMapping($inputData[6]));

    return $destination;
}

function getSeedsRange($seeds, $inputData) {
    
    $location = 0;

    for($idx = 0; $idx < $seeds[1]; $idx++) {
        
        $destination = walkMapping($seeds[0] + $idx, $inputData);
        echo $destination . PHP_EOL;

        if($location == 0) { $location = $destination; } 
        
        if($destination < $location) { $location = $destination; }
    }

    //for($idx = 0; $idx < $seeds[3]; $idx++) {
        
   //     $destination = walkMapping($seeds[2] + $idx, $inputData);

   //     if($location == 0) { $location = $destination; } 
        
  //      if($destination < $location) { $location = $destination; }
   // }

    return $location;
}

?>