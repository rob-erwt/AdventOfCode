<?php

$output = explode("\n", file_get_contents('inputday7test.txt'));

$curDirList = array();
$sizePerDir = array('/' => 0);

foreach($output as $line) {
     
    if($line[0] == "$") {

        // Line is command
        $cmdElements = explode(' ', $line);

        if($cmdElements[1] == 'cd') {

            if($cmdElements[2] == '..') {

                array_pop($curDirList);

            } else {

                $curDirList[] = $cmdElements[2];

            }
        }

    } elseif ($line[0] == 'd') {

        // Line is directory
        list($command, $name) = explode(' ', $line);
        $sizePerDir[$name] = $sizePerDir[$name] ?? 0;

    } else {

        // Line is file
        list($size, $file) = explode(' ', $line);

        foreach($curDirList as $dir) {
            $sizePerDir[$dir] += $size;
        }
    }
}

// PART 1
$total = 0;
foreach($sizePerDir as $size) {
    
    if($size <= 100000) { $total += $size; }
}

//var_dump($sizePerDir, $curDirList);

// 955251 -> to low
// Test: 95437
echo "Part 1: Total size: " . $total . PHP_EOL;
