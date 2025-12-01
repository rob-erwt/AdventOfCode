<?php

$inputData = explode("\n", file_get_contents('inputday2test.txt'));
$nrSafeReports = 0;

foreach($inputData as $report) {

    $numbers = explode(" ", $report);
    $lastNumber = $difference  = 0;
    $increase = $decrease = false;
    
    foreach($numbers as $number) {

        // First number so nothing to compare
        if(!$lastNumber) {
            $lastNumber = $number;
            continue;
        }

        $difference = $number - $lastNumber;

        // Difference is smaller then 1 of bigger then 3
        if(!$difference || abs($number - $lastNumber) > 3) {
            break;
        }

        $lastNumber = $number;
        $nrSafeReports++;
    }
}

echo "PART 1: Nr safe reports " . $nrSafeReports . PHP_EOL;


//echo "PART 2: Similarity score " . $similarityScore . PHP_EOL;

?>
