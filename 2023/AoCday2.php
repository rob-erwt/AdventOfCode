<?php

$gameIdSum = $gameIdPowerSum = 0;
$inputData = explode("\n", file_get_contents('inputday2.txt'));

$loaded = array("red" => 12, "green" => 13, "blue" => 14);

foreach($inputData as $line) {

    $minNumberList = array("red" => 1, "green" => 1, "blue" => 1);
    list($gameId, $sets) = explode(": ", $line);

    $gameId = trim($gameId, 'Game ');
    $sets = explode("; ", $sets);
    //var_dump($gameId,$sets);

    foreach($sets as $set) {
        $set = explode(", ", $set);
        
        foreach($set as $cube)
        {
            $cube = explode(" ", $cube);
            
            // PART 1
            if($loaded[$cube[1]] < $cube[0]) {
                $gameId = 0;
            }

            // PART 2
            if($minNumberList[$cube[1]] < $cube[0]) {
                $minNumberList[$cube[1]] = (int)$cube[0];
            }
        }
    }

    $gameIdSum += $gameId;
    $gameIdPowerSum += ($minNumberList['red'] * $minNumberList['green'] * $minNumberList['blue']);
}

echo "PART 1: Sum of possible Game ID's: " . $gameIdSum . PHP_EOL;
echo "PART 2: Sum of powers possible Game ID's: " . $gameIdPowerSum . PHP_EOL;

?>