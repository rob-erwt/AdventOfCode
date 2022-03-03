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

$nrValidSimple = $nrValidFull = 0;

// Part 1
foreach($passports as $passportLine)
{
    $passport = array_map(function($val) {
        return explode(':', $val);
    }, explode(" ", trim($passportLine)));

    if(isValidPassportFieldCount($passport, $optFields)) {
        $nrValidSimple++;
    }

    if(isValidPassportFull($passport, $optFields)) {
        $nrValidFull++;
    }
}

print_r("Part 1: Valid passports: " . $nrValidSimple . PHP_EOL);
print_r("Part 2: Valid passports: " . $nrValidFull . PHP_EOL);

function isValidPassportFieldCount($passport, $optFields)
{
    if(count($passport) == 8) {
        return true;
    }

    if(count($passport) == 7) {
        $hasCid = false;

        foreach($passport as $line) {
            if(in_array($line[0], $optFields)) {
                $hasCid = true;
            }
        }

        return !$hasCid;
    }

    return false;
}

function isValidPassportFull($passport, $optFields)
{
    if(!isValidPassportFieldCount($passport, $optFields)) {
        return false;
    }

    foreach($passport as list($field, $value)) {
        switch($field) {
            case 'byr':
                if(!($value >= 1920 &&  $value <= 2002)) {
                    return false;
                }
                break;
            
            case 'iyr':
                if(!($value >= 2010 &&  $value <= 2020)) {
                    return false;
                }
                break;

            case 'eyr':
                if(!($value >= 2020 &&  $value <= 2030)) {
                    return false;
                }
                break;

            case 'hgt':
                $type = substr($value, -2);
                $numeric = substr($value, 0, -2);

                if(!(
                    ($type == 'cm' && $numeric >= 150 && $numeric <= 193) ||
                    ($type == 'in' && $numeric >= 59 && $numeric <= 76)
                )) {
                    return false;
                }
                break;

            case 'hcl':
                if(!(
                    strlen($value) == 7 && 
                    substr($value, 0, 1) == "#" && 
                    ctype_xdigit(substr($value, 1))
                 )) {
                    return false;
                }
                print_r($field . ": " . $value . PHP_EOL);
                break;

            case 'ecl':
                if(!in_array($value, array('amb', 'blu', 'brn', 'gry', 'grn', 'hzl', 'oth'))){
                    return false;
                }
                break;

            case 'pid':
                if(!(strlen($value) == 9 && is_numeric($value))) {
                    return false;
                }
                break;

            default:
                
        }
    }

    return true;
}

?>