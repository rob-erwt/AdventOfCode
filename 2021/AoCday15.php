<?php

/* Code belonging with https://adventofcode.com/2021/day/15 */

// Reading input file
$map = array();
$inputLines = explode("\n", file_get_contents('inputday15test.txt'));
$maxY = sizeof($inputLines);
$maxX = 0;

for($i = 0; $i < sizeof($inputLines); $i++) 
{
    $points = str_split($inputLines[$i]);
    $maxX = sizeof($points);

    for($j = 0; $j < sizeof($points); $j++) 
    {
        $map[$i][$j] = $points[$j];
    }
}

$curX = $curY = 0;

while (true)
{
    if($curX == 10 && $curY == 10) { break; }

    $rightValue = $map[$curY][$curX + 1];
    $downValue = $map[$curY + 1][$curX];
}


?>