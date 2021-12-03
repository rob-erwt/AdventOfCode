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

/* Code belonging with https://adventofcode.com/2021/day/2 */

$diagnosticData = $diagnosticMap= array();
$nrOn = $nrOff = array();
$gammaRate = $epsilonRate = "";
$powerConsumption = 0;

// Reading input file
$diagnosticData = explode("\n", file_get_contents('inputday3.txt'));

// Test case
$diagnosticData = array('00100', '11110', '10110', '10111', '10101', '01111', '00111', '11100', '10000', '11001', '00010', '01010');

//print_r($diagnosticData);

foreach($diagnosticData as $diagLine) {
    if($diagLine) {
        $diagnosticMap[] = str_split($diagLine);
    }
}

//print_r($diagnosticMap);

$powerConsumption = calculatePowerConsumption($diagnosticMap);

print_r("Power consumption: " . $powerConsumption . "\n");

/**
 * PART ONE, DAY 3
 */
function calculatePowerConsumption($diagnosticMap) {
    foreach($diagnosticMap as $diagItem) {
        for($idx = 0; $idx < sizeof($diagItem); $idx++)
        {
            if($diagItem[$idx]) {
                $nrOn[$idx]++;
            }
            else {
                $nrOff[$idx]++;
            }
        }
    }

    ksort($nrOn);
    ksort($nrOff);

    for($idx = 0; $idx < sizeof($nrOn); $idx++) {
        if($nrOn[$idx] > $nrOff[$idx]) {
            $gammaRate .= "1";
            $epsilonRate .= "0";
        }
        else {
            $gammaRate .= "0";
            $epsilonRate .= "1";
        }
    }

    return(bindec($gammaRate) * bindec($epsilonRate));
}

?>