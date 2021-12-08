<?php

/* Code belonging with https://adventofcode.com/2020/day/2 */

// Reading input file
$inputData = explode("\n", file_get_contents('inputday2.txt'));

$nrValidPasswordsPart1 = 0;
$nrValidPasswordsPart2 = 0;

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
    $passwordArray = str_split($password);
    // -1 because postions start at 1, not 0
    if($passwordArray[$min-1] == $char xor $passwordArray[$max-1] == $char) {
        $nrValidPasswordsPart2++;
    }
}

print_r("Nr valid passwords (part 1): " . $nrValidPasswordsPart1 . PHP_EOL);
print_r("Nr valid passwords (part 2): " . $nrValidPasswordsPart2 . PHP_EOL);

?>