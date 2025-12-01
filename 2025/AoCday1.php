<?php

$inputData = explode("\n", file_get_contents('inputday1test.txt'));

$position = 50;
$nrZeros = 0;

foreach($inputData as $line) {
    $direction = $line[0];
    $movement = substr(trim($line, "LR"), -2);
    
    if($direction == "L") {
        $position -= $movement;
        if($position < 0) {
            $position += 100;
        }
    } elseif ($direction == "R") {
        $position += $movement;
        if($position >= 100) {
            $position -= 100;
        }
    }
    else { throw new Exception("Wrong direction", 1);
    }

    if($position == 0) {
        $nrZeros++;
    }
}

echo "Part 1: number of zeros: " . $nrZeros . PHP_EOL;