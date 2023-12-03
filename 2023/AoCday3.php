<?php

$inputData = explode("\n", file_get_contents('inputday3test.txt'));

$sumPartNumbers = 0;
$engineMatrix = array();

foreach($inputData as $line) { $engineMatrix[] = str_split($line); }

foreach($engineMatrix as $lineNr => $line) {

    $enginePartNr = '';
    $hasSymbolNeighbour = false;

    foreach($line as $linePos => $char) {

         // We encountered a number...
        if(is_numeric($char)) {

            // ... so lets start (or continue) fetching the complete part number
            $enginePartNr .= $char;

            // Check if there are neigbouring symbols, but only if we don't already know this
            if(!$hasSymbolNeighbour) {

                $hasSymbolNeighbour = checkNeigboursForSymbol($lineNr, $linePos, $engineMatrix);
            }

            // Special case: enginepart number is last on the line
            if($linePos == sizeof($line) - 1) {
                $sumPartNumbers += $hasSymbolNeighbour ? (int)$enginePartNr : 0;
            }

        } else {
            
            // Not numeric? Then either engine part number is finished or there is none. 
            // And only add if there are neigbouring symbols
            $sumPartNumbers += $hasSymbolNeighbour ? (int)$enginePartNr : 0;
            
            // Reset! Go look for the next engine part nr (in this line)
            $enginePartNr = '';
            $hasSymbolNeighbour = false;
        }
    }
}

echo "PART 1: Sum of part numbers: " . $sumPartNumbers . PHP_EOL;
//echo "PART 2: Sum of powers possible Game ID's: " . $gameIdPowerSum . PHP_EOL;

function checkNeigboursForSymbol($lineNr, $linePos, $engineMatrix) {

    $minLineNr = $minLinePos = 0;
    $maxLineNr = sizeof($engineMatrix);
    $maxLinePos = sizeof($engineMatrix[0]);

    // Get positions around current position
    $coords = array();
    if($lineNr) {

        if($linePos) { 
            $coords['nw'] = $engineMatrix[$lineNr-1][$linePos-1]; 
        }

        $coords['n'] = $engineMatrix[$lineNr-1][$linePos];
        
        if($linePos < $maxLinePos-1) { 
            $coords['ne'] =  $engineMatrix[$lineNr-1][$linePos+1];
        }
    }

    if($linePos) { $coords['w'] = $engineMatrix[$lineNr][$linePos-1]; }

    if($linePos < $maxLinePos-1) { 
        $coords['e'] =  $engineMatrix[$lineNr][$linePos+1]; 
    }

    if($lineNr < $maxLineNr - 1) {

        if($linePos) { 
            $coords['sw'] = $engineMatrix[$lineNr+1][$linePos-1]; 
        }

        $coords['s'] = $engineMatrix[$lineNr+1][$linePos];
        
        if($linePos < $maxLinePos-1) { 
            $coords['se'] =  $engineMatrix[$lineNr+1][$linePos+1]; 
        }
    }

    // A symbol is anything not a number or a .
    foreach($coords as $direction => $value) {
        if(!(is_numeric($value) || $value == '.'))
            return true;
    }

    return false;
}

?>