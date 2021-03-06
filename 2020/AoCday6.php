<?php

/* Code belonging with https://adventofcode.com/2020/day/6 */

// Reading input file
$groups = explode("\n\n", file_get_contents('inputday6.txt'));
$sumAnyYes = $sumAllYes = 0;

foreach($groups as $group) {
    
    // Part 1
    $sumAnyYes += sizeof(array_unique(str_split(preg_replace("/[^a-z]/", "", $group))));

    // Part 2
    $groupMembers = explode("\n", $group);

    // Only 1 grou member? All there yes-answers are counted
    if(sizeof($groupMembers) == 1) {
        $sumAllYes += strlen($groupMembers[0]);
    } else {

        // Generate list with answers (a to z)
        $allAnswers = array_fill_keys(range('a', 'z'), 0);
        
        // Get a list wth the yes-anwers for each group member
        foreach($groupMembers as $member) {
            foreach(str_split($member) as $answer) {
                $allAnswers[$answer]++;
            }
        }

        // If there are as many yes-answers as there are groupmembers, all members answered the question with yes
        foreach($allAnswers as $key => $value) {
            if($value == sizeof($groupMembers)) {
                $sumAllYes++;
            }
        }
    }

}

print_r("Part 1: Sum of any yes-answers: " . $sumAnyYes . PHP_EOL);
print_r("Part 2: Sum of all yes-answers: " . $sumAllYes . PHP_EOL);

?>