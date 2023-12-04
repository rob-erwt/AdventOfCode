<?php

$inputData = explode("\n", file_get_contents('inputday4.txt'));

$totalPoints = 0;

foreach($inputData as $line) { 
    
    $cardPoints = 0;

    list($card, $allNumbers) = explode(": ", $line);
    list($winningNumbers, $numbers) = explode(" | ", $allNumbers);

    $winningNumbers = preg_split("/[\s]+/", $winningNumbers);
    $numbers = preg_split("/[\s]+/", $numbers);

    foreach($numbers as $nr) {
        if(in_array($nr, $winningNumbers)) {
            $cardPoints = ($cardPoints ? $cardPoints * 2 : 1);
        }
    }

    $totalPoints += $cardPoints;
}

echo "PART 1: Total points: " . $totalPoints . PHP_EOL;
//echo "PART 2: Sum of powers possible Game ID's: " . $gameIdPowerSum . PHP_EOL;

?>