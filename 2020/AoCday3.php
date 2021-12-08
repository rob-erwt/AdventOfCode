<?php

/* Code belonging with https://adventofcode.com/2020/day/3 */

// Reading input file
$map = explode("\n", file_get_contents('inputday3.txt'));

$lineLength = strlen($map[0]);
$nrTrees = $nrSquares = $idx = 0;
$curPos = 0;

foreach($map as $line) {
    if($idx) {
        $curPos += 3;

        if($curPos > $lineLength) {
            $curPos = $curPos - $lineLength;
        }

        if(substr($line, $curPos, 1) == "#") {
            $nrTrees++;
        }
    }

    $idx++;
}

print_r("Nr of trees: " . $nrTrees . PHP_EOL);

?>