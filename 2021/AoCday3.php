<?php

/* Code belonging with https://adventofcode.com/2021/day/3 */

$diagnosticData = $diagnosticMap= array();

// Reading input file
$diagnosticData = explode("\n", file_get_contents('inputday3.txt'));
$diagnosticData = array_filter($diagnosticData);

// Test case
$diagnosticData = array('00100', '11110', '10110', '10111', '10101', '01111', '00111', '11100', '10000', '11001', '00010', '01010');

$powerConsumption = calculatePowerConsumption($diagnosticData);
$lifeSupportRating = verifyLifeSupportRating($diagnosticData);

print_r("Power consumption: " . $powerConsumption . "\n");
print_r("Life Support Rating: " . $lifeSupportRating . "\n");

/**
 * PART ONE, DAY THREE
 */
function calculatePowerConsumption($diagnosticData) {

    $diagnosticMap = splitDiagnosticData($diagnosticData);

    // Make sure we don't get warning on non-exsiting array keys
    $nrOn = array_fill(0, sizeof($diagnosticMap[0]), 0);
    $nrOff = array_fill(0, sizeof($diagnosticMap[0]), 0);

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

    // Resort array so keys start at 0 again
    ksort($nrOn);
    ksort($nrOff);

    $gammaRate = $epsilonRate = "";

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

    // Translate binary number to decimal and calculate Power Consumption
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

/**
 * Calculate the Oxygen Generator Rating ($isOxygen = true) or the CO2 Scrubber Rating ($isOxygen = false)
 */
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

    // Toggle to caculate Oxygen and take most common diagnostic value or CO2 ant take least common value
    $filterValue = (int)($isOxygen ? ($nrOn >= $nrOff) : ($nrOn < $nrOff));
    
    // Filter diagnostic data based on correct filtervalue
    $filteredItems = array_filter($diagnosticData, function($elem) use($idx, $filterValue){
        return substr($elem, $idx, 1) == $filterValue;
    });
    
    $idx++;

    // Recursive until we have one diagnostic vakue left
    return getRating($filteredItems, $idx, $isOxygen);
}

/**
 * Helper function to split input data in more usefull format (array of lines containing an array with seperate characters)
 */
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