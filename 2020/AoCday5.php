<?php

/* Code belonging with https://adventofcode.com/2020/day/5 */

// Reading input file
$lines = explode("\n", file_get_contents('inputday5.txt'));

$seatIDs = array();

// Part 1
foreach($lines as $boardingPass) {

    $rows = range(0, 127);
    $columns = range(0, 7);

    $instructions = str_split($boardingPass);

    foreach($instructions as $step) {
        switch($step) {

            case 'F':
                $rows = array_slice($rows, 0, (sizeof($rows)/2));
                break;

            case 'B':
                $rows = array_slice($rows, (sizeof($rows)/2), sizeof($rows));
                break;

            case 'R':
                $columns = array_slice($columns, (sizeof($columns)/2), sizeof($columns));
                break;

            case 'L':
                $columns = array_slice($columns, 0, (sizeof($columns)/2));
                break;
        }
    }

    $seatIDs[] = ($rows[0] * 8) + $columns[0];
}

rsort($seatIDs);

print_r("Part 1: Highest seat ID: " . $seatIDs[0] . PHP_EOL);

// Part 2
for($idx = end($seatIDs); $idx <= $seatIDs[0]; $idx++) {
    if(
        !in_array($idx, $seatIDs) && 
        in_array($idx-1, $seatIDs) && 
        in_array($idx+1, $seatIDs)
    ) {
        print_r("Part 2: My seat ID: " . $idx . PHP_EOL);
        exit();
    }
}

?>