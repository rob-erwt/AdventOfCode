<?php

$totalsPart1 = 0;
$totalsPart2 = 0;
$inputData = explode("\n", file_get_contents('inputday2.txt'));

foreach($inputData as $line) {
    list($first, $reaction) = explode(" ", $line);

    $totalsPart1 += calculateReactionValue($reaction);
    $totalsPart1 += calculateGameScore($first, $reaction);

    $move = getResult($first, $reaction);
    $totalsPart2 += calculateReactionValue($move);
    $totalsPart2 += calculateScoreOnResult($reaction);
}

echo "PART 1: Gamescore: " . $totalsPart1 . PHP_EOL;
echo "PART 2: Gamescore: " . $totalsPart2 . PHP_EOL;

function calculateReactionValue($option) {

    $value = 0;

    // Reaction value
    switch ($option) {
        case 'X':
        case 'A':
            $value = 1;
            break;
        case 'Y':
        case 'B':
            $value = 2;
            break;
        case 'Z':
        case 'C':
            $value = 3;
            break;
    }

    return $value;
}

function calculateGameScore($first, $second) {

    $score = 0;

    if($first == 'A' && $second == 'X') {
        $score += 3;
    }
    
    if($first == 'A' && $second == 'Y') {
        $score += 6;
    }

    if($first == 'B' && $second == 'Y') {
        $score += 3;
    }

    if($first == 'B' && $second == 'Z') {
        $score += 6;
    }

    if($first == 'C' && $second == 'Z') {
        $score += 3;
    }

    if($first == 'C' && $second == 'X') {
        $score += 6;
    }

    return $score;
}

function getResult($first, $outcome) {

    if($first == 'A') {
        
        if ($outcome == 'X') { return 'C'; }
        if ($outcome == 'Y') { return 'A'; }
        if ($outcome == 'Z') { return 'B'; }
    }

    if($first == 'B') {
        
        if ($outcome == 'X') { return 'A'; }
        if ($outcome == 'Y') { return 'B'; }
        if ($outcome == 'Z') { return 'C'; }
    }

    if($first == 'C') {
        
        if ($outcome == 'X') { return 'B'; }
        if ($outcome == 'Y') { return 'C'; }
        if ($outcome == 'Z') { return 'A'; }
    }

    return false;
}

function calculateScoreOnResult($result) {

    if($result == 'Y') { return 3; }
    if($result == 'Z') { return 6; }

    return 0;
}

?>