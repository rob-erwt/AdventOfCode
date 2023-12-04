<?php

$inputData = explode("\n", file_get_contents('inputday4.txt'));

$totalPoints = 0;
$totalCards = 0;
$cardList = array_fill_keys(range(1, sizeof($inputData)), 1);

foreach($inputData as $line) { 
    
    $cardPoints = $nrWinningNrs = 0;

    list($card, $allNumbers) = explode(": ", $line);
    $cardId = trim($card, "Card ");
    list($winningNumbers, $numbers) = explode(" | ", $allNumbers);

    $winningNumbers = preg_split("/[\s]+/", $winningNumbers, -1, PREG_SPLIT_NO_EMPTY);
    $numbers = preg_split("/[\s]+/", $numbers, -1, PREG_SPLIT_NO_EMPTY);

    foreach($numbers as $nr) {
        if(in_array($nr, $winningNumbers)) {

            $cardPoints = ($cardPoints ? $cardPoints * 2 : 1);

            $nrWinningNrs++;

        }
    }

    if($nrWinningNrs) {
        for($i = 0; $i < $cardList[$cardId]; $i++) {
            for($idx = 1; $idx <= $nrWinningNrs; $idx++) {
                $newCardId = $cardId + $idx;
                $cardList[$newCardId]++;
            }
        }
    }

    $totalPoints += $cardPoints;
}

$totalCards = array_sum($cardList);

echo "PART 1: Total points: " . $totalPoints . PHP_EOL;
echo "PART 2: Total cards: " . $totalCards . PHP_EOL;

?>