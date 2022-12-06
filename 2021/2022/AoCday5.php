<?php

list($stacksData, $moves) = explode("\n\n", file_get_contents('inputday5.txt'));

// Get the (transformed) stacks
$stacks = getStackArray($stacksData);
// Get all the moves
$moves = getMovesList($moves);

// PART 1
foreach ($moves as $move) {
    
    for($idx = 0; $idx < $move['move']; $idx++) {

        $box = array_shift($stacks[$move['from']-1]);
        array_unshift($stacks[$move['to']-1], $box);
    }
}

$code = '';
foreach($stacks as $stack) {
    $code .= $stack[0];
}

echo "Part 1: Code: " . $code . PHP_EOL;

// PART 2
// Reset the (transformed) stacks
$stacks = getStackArray($stacksData);

foreach ($moves as $move) {
    
    $boxes = array_splice($stacks[$move['from']-1], 0, $move['move']);
    $stacks[$move['to']-1] = array_merge($boxes, $stacks[$move['to']-1]);
}


$code = '';
foreach($stacks as $stack) {
    $code .= $stack[0];
}
echo "Part 2: Code: " . $code . PHP_EOL;


function getMovesList($moves) {

    $moves = explode("\n", $moves);
    foreach($moves as $move) {
        $move = explode(" ", $move);
        $movesList[] = array('move' => $move[1], 'from' => $move[3], 'to' => $move[5]);
    }

    return $movesList;
}

function getStackArray($stacksData) {

    $stacksData = explode("\n", $stacksData);
    $stackNumbers = array_pop($stacksData);
    $stackList = $stacks = array();

    // Create transformed array with correct size
    $nrColumns = str_split($stackNumbers, 4);
    for($idx = 0; $idx < sizeof($nrColumns); $idx++) {
        $stacks[$idx] = array();
    }

    // Transform stack/container data and add to right (transformed) array
    foreach($stacksData as $stack) {
        
        $idx = 0;
        $stackListItem = str_split($stack, 4);
        
        for($idx = 0; $idx < sizeof($stackListItem); $idx++) {
            
            $item = $stackListItem[$idx][1];
            if($item != ' ') {
                array_push($stacks[$idx], $item);
            }
        }
    }

    return $stacks;
}
