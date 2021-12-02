<?php

/**
 * Spoilers
 * Spoilers
 * Spoilers
 * Spoilers
 * Spoilers
 * Spoilers
 * Spoilers
 * Spoilers
 * Spoilers
 */

$prevLine = 0;
$nrLines = 0;
$increased = 0;

$handle = fopen("inputday1.txt", "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {

        $nrLines++;
        if($prevLine > 0 && $prevLine < $line)
            $increased++;

        $prevLine = $line;
    }

    fclose($handle);
} else {
    echo "Error opening file!\n";
} 

echo "Increased: " . $increased . "\n";

?>