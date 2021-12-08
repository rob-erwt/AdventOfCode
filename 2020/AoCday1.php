<?php

/* Code belonging with https://adventofcode.com/2020/day/1 */

// Reading input file
$inputData = explode("\n", file_get_contents('inputday1.txt'));
//$inputData = array("1721", "979", "366", "299", "675", "1456");

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
    
    $leftover = 2020 - (int)$firstNumber;
    
    foreach($inputData as $secondNumber) {
    
        $leftover2 = $leftover - (int)$secondNumber;

        if($leftover2) {

            $idx = array_search($leftover2, $inputData);

            if($idx){
                print_r("Answer part 2: " . ((int)$firstNumber * (int)$secondNumber * (int)$inputData[$idx]) . PHP_EOL);
                exit;
            }
        }
    }
}



?>