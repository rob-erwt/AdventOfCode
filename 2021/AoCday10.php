<?php

/* Code belonging with https://adventofcode.com/2021/day/10 */

// Reading input file
$inputData = explode("\n", file_get_contents('inputday10.txt'));

$chunks = array(
    "(" => ")",
    "[" => "]",
    "{" => "}",
    "<" => ">");

$illegalChunk = array(")" => 0, "]" => 0, "}" => 0, ">" => 0);
$autocompleteScore = array();

foreach($inputData as $line) {
    
    $chars = str_split($line);
    $openChunk = array();

    foreach($chars as $char) {
        
        if(array_key_exists($char, $chunks)) {
            $openChunk[] = $char; 
        }

        // Part 1
        if(in_array($char, $chunks) && array_search($char, $chunks) != array_pop($openChunk)) {
            $illegalChunk[$char]++;
            $openChunk = array();
            break;
        }
    }

    // Part 2
    if(sizeof($openChunk)) {
        $autocompleteScore[] = calculateAutocompleteScore($openChunk, $chunks);
    }
}

print_r("Syntax error score: " . calculateErrorScore($illegalChunk) . PHP_EOL);

sort($autocompleteScore);
$middleValue = floor(sizeof($autocompleteScore) / 2);

print_r("<iddle autocomplete score: " . $autocompleteScore[$middleValue] . PHP_EOL);

function calculateErrorScore($illegalChunk) {
    
    $value = 0;

    foreach($illegalChunk as $char => $cnt)
    {  
        switch ($char) {
            case ')':
                $value += ($cnt * 3);
                break;           
            case ']':
                $value += ($cnt * 57);
                break;
            case '}':
                $value += ($cnt * 1197);
                break;
            case '>':
                $value += ($cnt * 25137);
        }
    }

    return $value;
}

function calculateAutocompleteScore($openChunks, $chunks) {
    
    $totalScore = 0;
    $values = array(")" => 1, "]" => 2, "}" => 3, ">" => 4);

    while($openChunk = array_pop($openChunks)) {
        $totalScore = $totalScore * 5;
        $closeChunk = $chunks[$openChunk];
        $totalScore += $values[$closeChunk];
    }

    return $totalScore;
}

?>