<?php

/* Code belonging with https://adventofcode.com/2021/day/7 */

// Reading input file
$crabs = explode(",", file_get_contents('inputday7.txt'));
//$crabs = explode(",", "16,1,2,0,4,2,7,1,2,14");

$distListPart1 = $distListPart2 = array();

// Part 1
foreach(range(min($crabs), max($crabs)) as $dist) {

    foreach($crabs as $crab) {

        // Part 1
        $distListPart1[$dist] ??= 0;
        $distListPart1[$dist] += abs($crab - $dist);

        // Part 2
        $distListPart2[$dist] ??= 0;
        $fuel = abs($crab - $dist);
        for($i = $fuel - 1; $i >= 0; $i--) {
            $fuel += $i;
        }
        $distListPart2[$dist] += $fuel;

    }
}

print_r("Least fuel (1): " . min(array_values($distListPart1)) . PHP_EOL);
print_r("Least fuel (2): " . min(array_values($distListPart2)) . PHP_EOL);

?>