<?php

// PART 1
$stream = str_split(file_get_contents('inputday6.txt'));
$counter = getUniqueMarker($stream, 4);
echo "Part 1: Processed chars: " . $counter . PHP_EOL;

// PART 2
$stream = str_split(file_get_contents('inputday6.txt'));
$counter = getUniqueMarker($stream, 14);
echo "Part 2: Processed chars: " . $counter . PHP_EOL;


function getUniqueMarker($stream, $size)
{
    $marker = array_splice($stream, 0, $size);
    $idx = $size;

    while(sizeof($stream)) {

        if(sizeof(array_unique($marker)) == $size) {
            
            return $idx;

        } 

            array_shift($marker);
            $marker = array_merge($marker, array_splice($stream, 0, 1));
            $idx++;

        
    }

    return false;
}
<?php

// PART 1
$stream = str_split(file_get_contents('inputday6.txt'));
$counter = getUniqueMarker($stream, 4);
echo "Part 1: Processed chars: " . $counter . PHP_EOL;

// PART 2
$stream = str_split(file_get_contents('inputday6.txt'));
$counter = getUniqueMarker($stream, 14);
echo "Part 2: Processed chars: " . $counter . PHP_EOL;


function getUniqueMarker($stream, $size)
{
    $marker = array_splice($stream, 0, $size);
    $idx = $size;

    while(sizeof($stream)) {

        if(sizeof(array_unique($marker)) == $size) {
            
            return $idx;

        } 

        array_shift($marker);
        $marker = array_merge($marker, array_splice($stream, 0, 1));
        $idx++;
        
    }

    return false;
}
