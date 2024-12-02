<?php

$inputData = explode("\n", file_get_contents('inputday7test.txt'));
$hands = $games = $endList = array();
$totalWinnings = $idx = 0;

$types = array("HighCard", "OnePair", "TwoPair", "ThreeOfAKind", "FullHouse", "FopurOfAKind", "FiveOfAKind");

foreach($inputData as $game) {
    list($hand, $bid) = explode(" ", $game);

    $hands = getHandType($hand, $bid, $hands);    
}

foreach($types as $type) {

    if(isset($hands[$type])) {

        $typeHands = $hands[$type];
        krsort($typeHands);
        $endList = array_merge($endList, $typeHands);
    }
}

var_dump($endList);

foreach($endList as $hand => $value) {

    $idx++;
    $totalWinnings += ($value * $idx);
}

echo "PART 1: Total winnings: " . $totalWinnings . PHP_EOL;

function getHandType($hand, $bid, $hands) {

    $hand = str_split($hand);
    $counts = array_count_values($hand);
    usort($hand, "camelCardSort");
    $hand = implode('', $hand);
    arsort($counts);
    
    if(sizeof($counts) == 1) {
        $hands['FiveOfAKind'][$hand] = $bid;

    } elseif(sizeof($counts) == 2) {
        
        $first = array_shift($counts);

        if($first == 4) { $hands['FourOfAKind'][$hand] = $bid; }

        if($first == 3) { $hands['FullHouse'][$hand] = $bid; }

    } elseif(sizeof($counts) == 3) {

        $first = array_shift($counts);

        if($first == 3) { $hands['ThreeOfAKind'][$hand] = $bid; }

        if($first == 2) { $hands['TwoPair'][$hand] = $bid; }

    } elseif(sizeof($counts) == 4) {

        $hands['OnePair'][$hand] = $bid;

    } elseif(sizeof($counts) == 5) {

        $hands['HighCard'][$hand] = $bid;
    }

    return $hands;
}

function camelCardSort($a, $b){
    $cardOrder = array('A' => 0, 'K' => 1, 'Q' => 2, 'J' => 3, 'T' => 4, '9' => 5, '8' => 6, '7' => 7, '6' => 8, '5' => 9, '4' => 10, '3' => 11, '2' => 12);

    return ($cardOrder[$a] < $cardOrder[$b]) ? -1 : 1;
    return 0;

}

?>