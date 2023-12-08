<?php

$inputData = explode("\n", file_get_contents('inputday6.txt'));

$time = preg_split("/[\s]+/", trim($inputData[0], "Time:"), -1, PREG_SPLIT_NO_EMPTY);
$distance = preg_split("/[\s]+/", trim($inputData[1], "Distance:"), -1, PREG_SPLIT_NO_EMPTY);
$races = array_combine($time, $distance);

$winningRaces = array();

foreach($races as $raceLength => $recordDistance) {
    $winningRaces[] = calculateNrWinningGames($raceLength, $recordDistance);
}

echo "PART 1: Multiply winning numbers " . array_product($winningRaces) . PHP_EOL;

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