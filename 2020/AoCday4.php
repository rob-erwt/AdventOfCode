<?php

/* Code belonging with https://adventofcode.com/2020/day/4 */

// Reading input file
$lines = explode("\n", file_get_contents('inputday4.txt'));
$passports = array();
$idx = 0;
$passports[0] = '';

foreach($lines as $line) {

    if($line) {
        $passports[$idx] .= $line . " ";
    } else {
        $idx++;
        $passports[$idx] = '';
    }
}

$manFields = array('byr', 'iyr', 'eyr', 'hgt', 'hcl', 'ecl', 'pid');
$optFields = array('cid');

$nrValid = 0;

foreach($passports as $passportLine)
{
    $passport = array_map(function($val) {
        return explode(':', $val);
    }, explode(" ", trim($passportLine)));

    if(count($passport) == 7) {
        $hasCid = false;

        foreach($passport as $line) {
            if(in_array($line[0], $optFields)) {
                $hasCid = true;
            }
        }

        if(!$hasCid) {
            $nrValid++;
        }
    }

    if(count($passport) == 8) {
        $nrValid++;
        continue;
    }
}

print_r("Valid passports: " . $nrValid . PHP_EOL);

?>