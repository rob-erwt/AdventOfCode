<?php

$gameIdSum = 0;
$inputData = explode("\n", file_get_contents('inputday2.txt'));

$loaded = array("red" => 12, "green" => 13, "blue" => 14);

foreach($inputData as $line) {

    // PART 1
    list($gameId, $sets) = explode(": ", $line);

    $gameId = trim($gameId, 'Game ');
    $sets = explode("; ", $sets);
    //var_dump($gameId,$sets);

    foreach($sets as $set) {
        $set = explode(", ", $set);
        
        foreach($set as $cube)
        {
            $cube = explode(" ", $cube);
            
            if($loaded[$cube[1]] < $cube[0]) {
                $gameId = 0;
            }
        }
    }

    $gameIdSum += $gameId;
}

echo "PART 1: Sum of possible Game ID's: " . $gameIdSum . PHP_EOL;
//echo "PART 2: Sum all calibrations: " . $calibrationSumPt2 . PHP_EOL;

?>