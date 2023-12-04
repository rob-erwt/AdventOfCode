<?php

$inputData = explode("\n", file_get_contents('inputday4test.txt'));

$totalPoints = 0;
$cardList = array_fill_keys(range(1, sizeof($inputData)), 1);

foreach($inputData as $line) { 
    
    $cardPoints = $nrWinningNrs = 0;

    list($card, $allNumbers) = explode(": ", $line);
    list($winningNumbers, $numbers) = explode(" | ", $allNumbers);

    $winningNumbers = preg_split("/[\s]+/", $winningNumbers, -1, PREG_SPLIT_NO_EMPTY);
    $numbers = preg_split("/[\s]+/", $numbers, -1, PREG_SPLIT_NO_EMPTY);

    foreach($numbers as $nr) {
        if(in_array($nr, $winningNumbers)) {

            // PART 1
            $cardPoints = ($cardPoints ? $cardPoints * 2 : 1);
            // PART 2
            $nrWinningNrs++;

        }
    }

    $totalPoints += $cardPoints;

    // PART 2
    $cardId = trim($card, "Card ");
    
    if($nrWinningNrs) {

        for($i = 0; $i < $cardList[$cardId]; $i++) {

            for($idx = 1; $idx <= $nrWinningNrs; $idx++) {

                $cardList[$cardId + $idx]++;

            }
        }
    }
}

echo "PART 1: Total points: " . $totalPoints . PHP_EOL;
echo "PART 2: Total cards: " . array_sum($cardList) . PHP_EOL;

?>