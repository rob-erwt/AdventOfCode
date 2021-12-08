<?php

/* Code belonging with https://adventofcode.com/2020/day/2 */

// Reading input file
$inputData = explode("\n", file_get_contents('inputday2.txt'));

$nrValidPasswordsPart1 = 0;

foreach($inputData as $line) {
    list($count, $char, $password) = explode(" ", $line);
    list($min, $max) = explode("-", $count);
    $char = rtrim($char, ":");

    // Part 1
    $cnt = substr_count($password, $char);

    if($cnt >= $min && $cnt <= $max) {
        $nrValidPasswordsPart1++;
    }

    // Part 2
    
}

print_r("Nr valid passwords (part 1): " . $nrValidPasswordsPart1 . PHP_EOL);

?>