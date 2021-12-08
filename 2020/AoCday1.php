<?php

/* Code belonging with https://adventofcode.com/2020/day/1 */

// Reading input file
$inputData = explode("\n", file_get_contents('inputday1.txt'));
//$inputData = array("1721", "979", "366", "299", "675", "1456");

foreach($inputData as $number) {

    $leftOver = 2020 - (int)$number;
    $idx = array_search($leftOver, $inputData);

    if($idx){
        $total = (int)$inputData[$idx] * (int)$number;
        print_r("Answer: ". $total . PHP_EOL);
        exit;
    }
}

print_r("No sum to 2020 found... :(" . PHP_EOL);

?>