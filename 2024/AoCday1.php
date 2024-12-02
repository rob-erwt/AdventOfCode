<?php

$inputData = explode("\n", file_get_contents('inputday1.txt'));

foreach($inputData as $line) {
    $line = explode("   ", $line);
    $locationsLeft[] = $locationsLeft2[] = $line[0];
    $locationsRight[] = $locationsRight2[]= $line[1];
}

sort($locationsLeft);
sort($locationsRight);

$totalDistance = $similarityScore = 0;

for($idx = 0; $idx < sizeof($locationsLeft); $idx++) {
    $totalDistance += abs($locationsLeft[$idx] - $locationsRight[$idx]);
}

echo "PART 1: Total distance " . $totalDistance . PHP_EOL;

$nrOcurrences = array_count_values($locationsRight2);

foreach($locationsLeft2 as $locationNr) { 
    if(isset($nrOcurrences[$locationNr])) {
        $similarityScore += ($nrOcurrences[$locationNr] * $locationNr);
    }
}

echo "PART 2: Similarity score " . $similarityScore . PHP_EOL;

?>
