<?php

/* Code belonging with https://adventofcode.com/2021/day/10 */

// Reading input file
$inputData = explode("\n", file_get_contents('inputday10.txt'));

$chunks = array(
    "(" => ")",
    "[" => "]",
    "{" => "}",
    "<" => ">");

$openChunk = array();
$illegalChunk = array(")" => 0, "]" => 0, "}" => 0, ">" => 0);

foreach($inputData as $line) {
    
    $chars = str_split($line);

    foreach($chars as $char) {
        
        if(array_key_exists($char, $chunks)) {
            $openChunk[] = $char; 
        }

        if(in_array($char, $chunks) && array_search($char, $chunks) != array_pop($openChunk)) {
            $illegalChunk[$char]++;
            break;
        }
    }
}

print_r("Syntax error score: " . calculateErrorScore($illegalChunk) . PHP_EOL);


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

?>