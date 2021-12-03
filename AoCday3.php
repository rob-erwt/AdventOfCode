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

// Reading input file
$diagnosticData = explode("\n", file_get_contents('inputday3.txt'));
$diagnosticData = array_filter($diagnosticData);

// Test case
$diagnosticData = array('00100', '11110', '10110', '10111', '10101', '01111', '00111', '11100', '10000', '11001', '00010', '01010');

$diagnosticMap = splitDiagnosticData($diagnosticData);

$powerConsumption = calculatePowerConsumption($diagnosticMap);
$lifeSupportRating = verifyLifeSupportRating($diagnosticData);

print_r("Power consumption: " . $powerConsumption . "\n");
print_r("Life Support Rating: " . $lifeSupportRating . "\n");

/**
 * PART ONE, DAY THREE
 */
function calculatePowerConsumption($diagnosticMap) {

    $nrOn = $nrOff = array();
    $gammaRate = $epsilonRate = "";
    $powerConsumption = 0;

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

/**
 * PART TWO, DAY THREE
 */
function verifyLifeSupportRating($diagnosticData) {

    $oxygenGeneratorRatingArray = getRating($diagnosticData);
    $oxygenGeneratorRating = bindec(array_values($oxygenGeneratorRatingArray)[0]);

    $co2ScrubberRatingArray = getRating($diagnosticData, false);
    $co2ScrubberRating = bindec(array_values($co2ScrubberRatingArray)[0]);

    return($oxygenGeneratorRating * $co2ScrubberRating);
}

function getRating($diagnosticData, $isOxygen = true, $idx = 0)
{
    if(sizeof($diagnosticData) <= 1)
        return $diagnosticData;

    $diagnosticMap = splitDiagnosticData($diagnosticData); 

    $nrOn = $nrOff = 0;

    foreach($diagnosticMap as $line) {
        if($line[$idx])
            $nrOn++;
        else
            $nrOff++;
    }

    $filterValue = (int)($nrOn >= $nrOff);
    $filterValue = $isOxygen ? $filterValue : !$filterValue;
    
    $filteredItems = array_filter($diagnosticData, function($elem) use($idx, $filterValue){
        return substr($elem, $idx, 1) == $filterValue;
    });
    
    $idx++;

    return getRating($filteredItems, $idx, $isOxygen);
}

function splitDiagnosticData($diagnosticData)
{
    $diagnosticMap = array();

    foreach($diagnosticData as $diagLine) {
        if($diagLine) {
            $diagnosticMap[] = str_split($diagLine);
        }
    }

    return $diagnosticMap;
}

?>