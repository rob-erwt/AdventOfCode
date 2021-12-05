<?php

/* Code belonging with https://adventofcode.com/2021/day/5 */

// Reading input file
$inputData = array_filter(explode("\n", file_get_contents('inputday5.txt')));
$map = array();
$nrIntersections = 0;

foreach ($inputData as $line) {
    $set = explode(" -> ", $line);
    list($x1, $y1) = explode(",", $set[0]);
    list($x2, $y2) = explode(",", $set[1]);

    if($x1 != $x2 && $y1 != $y2) {
        continue;
    }

    if($x1 == $x2) {
        $startY = max(array($y1, $y2));
        $endY = min(array($y1, $y2));

        for($startY; $startY >= $endY; $startY--) {
            $map[$x1][$startY] += 1;
        }
    }

    if($y1 == $y2) {
        $startX = max(array($x1, $x2));
        $endX = min(array($x1, $x2));

        for($startX; $startX >= $endX; $startX--) {
            $map[$startX][$y1] += 1;
        }
    }
}

foreach($map as $line) {
    foreach($line as $value) {
        if($value >= 2)
            $nrIntersections++;
    }
}

print_r("Nr intersections: " . $nrIntersections . "\n");

?>