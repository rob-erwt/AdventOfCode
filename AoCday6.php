<?php

/* Code belonging with https://adventofcode.com/2021/day/6 */

// Reading input file
$inputData = file_get_contents('inputday6.txt');
//$inputData = "3,4,3,1,2";

$fishSchool = array_filter(explode(",", $inputData));

// Part 1
$nrDays = 80;
print_r("Total fish after day " . $nrDays . ": " . partOne($fishSchool, $nrDays) . PHP_EOL);

// Part 2
$nrDays = 256;
print_r("Total fish after day " . $nrDays . ": " . partTwo($fishSchool, $nrDays) . PHP_EOL);

function partOne($fishSchool, $nrDays) {

    for($day = 1; $day <= $nrDays; $day++) {

        $newFish = array();

        for ($idx = 0; $idx < sizeof($fishSchool); $idx++) { 

            if($fishSchool[$idx]) {
                $fishSchool[$idx]--;
            }
            else {
                $fishSchool[$idx] = 6;
                $newFish[] = 8;
            }
        }

        $fishSchool = array_merge($fishSchool, $newFish);
    }
    return sizeof($fishSchool);
}

function partTwo($fishSchool, $nrDays) {

    $ageGroups = array(0,0,0,0,0,0,0,0,0);
    
    // Transform to list of nr of fish per fish-age
    foreach($fishSchool as $fish) {
        $ageGroups[(int)$fish]++;
    }

    for($i = 0; $i < $nrDays; $i++) {
        
        $updGroup = array(0,0,0,0,0,0,0,0,0);
        foreach ($ageGroups as $age => $value) {

            if($age != 0) {
                $updAge = $age - 1;
                $updGroup[$updAge] += $value;
            }

            if($age == 0) {
                $updGroup[6] += $value;
                $updGroup[8] += $value;
            }
        }

        $ageGroups = $updGroup;
    }
    return array_sum($ageGroups);
}

?>