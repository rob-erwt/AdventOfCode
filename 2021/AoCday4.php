<?php

/* Code belonging with https://adventofcode.com/2021/day/4 */

// Reading input file
$inputData = explode("\n\n", file_get_contents('inputday4.txt'));
$randomNr = explode(",", array_shift($inputData));

$bingoCards = array();

foreach($inputData as $card)
{
    $bingoCard = new BingoCard($card);
    $bingoCards[] = $bingoCard;
}

foreach($randomNr as $number) {

    foreach($bingoCards as $card)
    {
        $card->updateCard($number);
    }

    for($idx = 0; $idx < sizeof($bingoCards); $idx++) {
    
        $bingoCard = $bingoCards[$idx];
        if($bingoCard->hasBingo()) {

            $value = calculateCardValue($number, $bingoCard);
            print_r("Winning value: " . $value . "\n");

            unset($bingoCards[$idx]);
            $bingoCards = array_values($bingoCards);
        }
    }
}

function calculateCardValue($number, BingoCard $card) {
    $sum = 0;
    $bingoCard = $card->getCard();

    foreach($bingoCard as $line) {
        foreach ($line as $item) {
            if(is_numeric($item)) {
                $sum += $item;
            }
        }
    }
    $value = $number * $sum;
    return $value;
}

class BingoCard {
    protected $card = array();

    public function __construct($cardData) {
        $rows = explode("\n", $cardData);

        foreach($rows as $row) {
            $columns = explode(" ", $row);
            $cardRow = array();

            foreach($columns as $column) {
                if(is_numeric($column))
                    $cardRow[] = $column;
            }

            $this->card[] = $cardRow;
        }
    }

    public function getCard() {
        return $this->card;
    }

    public function updateCard($nr) {
        for ($i = 0; $i < sizeof($this->card); $i++) {
            $line = $this->card[$i];

            for ($j = 0; $j < sizeof($line); $j++) {

                if($line[$j] == $nr)
                    $this->card[$i][$j] = 'X';
            }
        }
    }

    public function hasBingo() {
        
        for($i = 0; $i < 5; $i++)
        {
            if($this->card[$i][0] == 'X' &&
                $this->card[$i][1] == 'X' &&
                $this->card[$i][2] == 'X' &&
                $this->card[$i][3] == 'X' &&
                $this->card[$i][4] == 'X') {
                return true;
            }

            if($this->card[0][$i] == 'X' &&
                $this->card[1][$i] == 'X' &&
                $this->card[2][$i] == 'X' &&
                $this->card[3][$i] == 'X' &&
                $this->card[4][$i] == 'X') {
                return true;
            }
        }

        return false;
    }

}

?>