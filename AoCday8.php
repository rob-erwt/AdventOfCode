<?php

/* Code belonging with https://adventofcode.com/2021/day/8 */

// Build info on digits
$digits = array(
    0 => "abcefg",
    1 => "cf",
    2 => "acdeg",
    3 => "acdfg",
    4 => "bcdf",
    5 => "abdfg",
    6 => "abdefg",
    7 => "acf",
    8 => "abcdefg",
    9 => "abcdfg"
);

// Reading input file
$inputData = explode("\n", file_get_contents('inputday8.txt'));
$parsedInput = array();

// Parse input data into datastructure: array("signalPattern" => array(), "digitalOutput" => array())
foreach($inputData as $line) {
    list($signalPattern, $digitOutput) = explode(" | ", $line);

    $parsedInput[] = array(
        'signalPattern' => explode(" ", $signalPattern),
        'digitalOutput' => explode(" ", $digitOutput)
    );
}

// Part 1
$countNumbers = countNumbers($parsedInput, $digits);
print_r("Number of 1, 4, 7 & 8 digits: " . array_sum($countNumbers) . PHP_EOL);

// Part 2
$total = 0;

foreach($parsedInput as $item) {
    $translatedDigits = translateChars($item["signalPattern"], $digits);
    $translatedDigits = orderTranslatedDigits($translatedDigits);
    
    $digitalOutputSorted = orderTranslatedDigits($item['digitalOutput']);
    
    $number = '';
    foreach($digitalOutputSorted as $digitalOutput)
    {
        $number .= array_search($digitalOutput, $translatedDigits);
    }

    $total += (int)$number;
}

print_r("Total output values: " . $total . PHP_EOL);


function countNumbers($parsedInput, $digits) {

    $countNumbers = array("1" => 0, "4" => 0, "7" => 0, "8" => 0);

    foreach($parsedInput as $line) {
        $digitalOutput = $line['digitalOutput'];

        foreach($digitalOutput as $item) {
            switch (strlen($item)) {
                case strlen($digits[1]):
                    $countNumbers[1]++;
                    break;
                case strlen($digits[4]):
                    $countNumbers[4]++;
                    break;
                case strlen($digits[7]):
                    $countNumbers[7]++;
                    break;
                case strlen($digits[8]):
                    $countNumbers[8]++;
                    break;
            }
        }
    }

    return $countNumbers;
}

function translateChars($signalPattern, $digits)
{
    $translatedDigits = array();

    foreach($signalPattern as $item) {

        // 1
        if(strlen($item) == strlen($digits[1])) {
            $translatedDigits[1] = $item;
        }

        // 4
        if(strlen($item) == strlen($digits[4])) {
            $translatedDigits[4] = $item;
        }

        // 7
        if(strlen($item) == strlen($digits[7])) {
            $translatedDigits[7] = $item;
        }

        // 8
        if(strlen($item) == strlen($digits[8])) {
            $translatedDigits[8] = $item;
        }
    }

    foreach($signalPattern as $item) {

        // 9, 0, or 6
        if(strlen($item) == 6) {
            if(sizeof(array_intersect(str_split($item), str_split($translatedDigits[4]))) == 4) {
                $translatedDigits[9] = $item;
            } elseif(sizeof(array_intersect(str_split($item), str_split($translatedDigits[1]))) == 2) {
                $translatedDigits[0] = $item;
            } else {
                $translatedDigits[6] = $item;
            }
        }
    }

    foreach($signalPattern as $item) {
        
        // 3, 2 or 5
        if(strlen($item) == 5) {
            if(sizeof(array_intersect(str_split($item), str_split($translatedDigits[1]))) == 2) {
                $translatedDigits[3] = $item;
            } elseif(sizeof(array_intersect(str_split($item), str_split($translatedDigits[9]))) == 4) {
                $translatedDigits[2] = $item;
            } else {
                $translatedDigits[5] = $item;
            }
        }
    }

    return $translatedDigits;
}

function orderTranslatedDigits($translatedDigits) {

    $sortedDigits = array();

    foreach($translatedDigits as $key => $digit) {
        $digitArray = str_split($digit);
        asort($digitArray);

        $sortedDigits[$key] = implode('', $digitArray);
    }
    
    return $sortedDigits;
}

?>