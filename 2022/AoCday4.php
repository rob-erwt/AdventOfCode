<?php

$inputData = explode("\n", file_get_contents('inputday4.txt'));
$nrContainingRanges = 0;
$nrOverlap = 0;

foreach($inputData as $line) {
    
    list($first, $second) = explode(',', $line);
    
    $first = explode('-', $first);
    $firstList = range($first[0], $first[1]);

    $second = explode('-', $second);
    $secondList = range($second[0], $second[1]);

    // PART 1
    if(!sizeof(array_diff($firstList, $secondList)) || !sizeof(array_diff($secondList, $firstList))) {
        $nrContainingRanges++;
    }

    // PART 2
    if(sizeof(array_intersect($firstList, $secondList))) {
        $nrOverlap++;
    }
}

echo "Part 1: Nr containing ranges: " . $nrContainingRanges . PHP_EOL;
echo "Part 2: Nr no overlap: " . $nrOverlap . PHP_EOL;


?>