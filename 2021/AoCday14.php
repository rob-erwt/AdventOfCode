<?php

/* Code belonging with https://adventofcode.com/2021/day/14 */

// Reading input file
$inputData = explode("\n\n", file_get_contents('inputday14test.txt'));
$basePolymer = $inputData[0];
$insertionRules = splitRules($inputData[1]);

$nrLoops = 10;

while($nrLoops){

    
    $nrLoops--;
}

function splitRules($rawRules) {
    
    $insertionRules = array();
    $splitRules = explode("\n", $rawRules);

    foreach($splitRules as $rule) {
        list($pattern, $insert) = explode(" -> ", $rule);
        $insertionRules[$pattern] = $insert;
    }

    return($insertionRules);
}

?>