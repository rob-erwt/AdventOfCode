<?php

/* Code belonging with https://adventofcode.com/2020/day/1 */

// Reading input file
$inputData = explode("\n", file_get_contents('inputday1.txt'));
$inputData = array("1721", "979", "366", "299", "675", "1456");

// Part 1
foreach($inputData as $number) {

    $idx = array_search(2020 - (int)$number, $inputData);

    if($idx){
        print_r("Answer part 1: ". ((int)$inputData[$idx] * (int)$number) . PHP_EOL);
        break;
    }
}

// Part 2
foreach($inputData as $firstNumber) {

    $leftOver = 2020 - (int)$firstNumber;
    
}



?>