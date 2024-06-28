<?php

namespace App\Services;

class RomanNumeralService
{
    protected $romans = [
        'C̅' => 100000, 
        'L̅X̅C̅' => 90000,
        'L̅' => 50000,
        'X̅L̅' => 40000,
        'X̅' => 10000,
        'I̅X̅' => 9000,
        'V̅' => 5000,
        'I̅V̅' => 4000,
        'M' => 1000,
        'CM' => 900,
        'D' => 500,
        'CD' => 400,
        'C' => 100,
        'XC' => 90,
        'L' => 50,
        'XL' => 40,
        'X' => 10,
        'IX' => 9,
        'V' => 5,
        'IV' => 4,
        'I' => 1,
    ];

    public function numberToRoman($num) {
        $result = '';
        foreach ($this->romans as $key => $value) {
            $matches = intval($num / $value);
            $result .= str_repeat($key, $matches);
            $num = $num % $value;
        }

        return $result;
    }

    public function romanToNumber($roman) {
        $result = 0;
        $i = 0;

        while ($roman != '' && $i < strlen($roman)) {
            //we assume groups of two
            $twoChar = substr($roman, $i, 2);
            //lets see if they are actually roman characters
            if (array_key_exists($twoChar, $this->romans)) {
                $result += $this->romans[$twoChar];
                $i += 2;
                continue;
            }
            //maybe its just a single roman numeral
            $oneChar = $roman[$i];
            if (array_key_exists($oneChar, $this->romans)) {
                $result += $this->romans[$oneChar];
                $i++;
            } else {
                //Non existent value
                $result = null;
                break;
            }
        }

        return $result;
    }
}
