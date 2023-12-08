<?php

$inputData = explode("\n", file_get_contents('inputday6.txt'));

// Part 1
$time = preg_split("/[\s]+/", trim($inputData[0], "Time:"), -1, PREG_SPLIT_NO_EMPTY);
$distance = preg_split("/[\s]+/", trim($inputData[1], "Distance:"), -1, PREG_SPLIT_NO_EMPTY);
$races = array_combine($time, $distance);

$winningRaces = array();

foreach($races as $raceLength => $recordDistance) {
    $winningRaces[] = calculateNrWinningGames($raceLength, $recordDistance);
}

echo "PART 1: Multiply winning numbers " . array_product($winningRaces) . PHP_EOL;

// Part 2
$time = str_replace(" ", "", trim($inputData[0], "Time:"));
$distance = str_replace(" ", "", trim($inputData[1], "Distance:"));

$winningRaces = calculateNrWinningGames($time, $distance);

echo "PART 2: Multiply winning numbers " . $winningRaces . PHP_EOL;

function calculateNrWinningGames($raceLength, $recordDistance) {

    $winningTimings = 0;

    for($i = 0; $i <= $raceLength; $i++) {
        $distance = $i * ($raceLength - $i);
        
        if($recordDistance < $distance) {
            $winningTimings++;
        }
    }

    return $winningTimings;
}

?>