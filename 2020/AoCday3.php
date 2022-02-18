<?php

/* Code belonging with https://adventofcode.com/2020/day/3 */

// Reading input file
$map = explode("\n", file_get_contents('inputday3.txt'));

// Part 1
$nrTrees = traverseMap($map, 3, 1);

print_r("PART 1: Nr of trees: " . $nrTrees . PHP_EOL);

// Part 2
$nrTrees = array();
$slopes = array([1,1], [3,1], [5,1], [7,1], [1,2]);

foreach($slopes as $slope) {
    $nrTrees[] = traverseMap($map, $slope[0], $slope[1]);
}

print_r("PART 2: Nr of trees: " . array_product($nrTrees) . PHP_EOL);


function traverseMap($map, $posSteps, $lineSteps) {

    $curPos = $nrTrees = 0;
    $curLine = '';

    for($i = $lineSteps; $i < count($map); $i += $lineSteps) {
        $curLine = $map[$i];

        $curPos += $posSteps;

        if($curPos > strlen($curLine) - 1) {
            $curPos = $curPos - strlen($curLine);
        }

        if(substr($curLine,$curPos,1) == '#') {
            $nrTrees++;
        }
    }
    
    return $nrTrees;
}

?>