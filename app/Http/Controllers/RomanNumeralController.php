<?php

namespace App\Http\Controllers;

use App\Models\RomanNumeral;
use Illuminate\Http\Request;
use App\Models\Numbers;
use Illuminate\Support\Facades\DB;


class RomanNumeralController extends Controller
{
    public function convertTo(Request $request)
    {
        $number = $request->input('number');

        if($number < 1 || $number > 100000) {
            return redirect()->back()->withErrors(['error' => 'Invalid number provided.']);
        }

        $romanNumeral = $this->numberToRoman($number);

        //db support for extra features, dont add if we already have it
        if(DB::table('numbers')->where('value', $number)->first()){
            return redirect()->route('numbers.index')->with('romanNumeral', $romanNumeral);
        }

        if($romanNumeral){
            $newNumber = new Numbers;
            $newNumber->value = $number; 
            $newNumber->save(); 

            $roman = new RomanNumeral; 
            $roman->number_id = $newNumber->id;
            $roman->value = $romanNumeral;
            $roman->save();
        }
        return redirect()->route('numbers.index')->with('romanNumeral', $romanNumeral);
    }

    public function convertFrom(Request $request)
    {
        $roman = $request->input('roman');

        if(empty($roman)) {
            return redirect()->back()->withErrors(['msg' => 'Please provide a Roman numeral.']);
        }

        $integerValue = $this->romanToNumber($roman);
        //db support for extra features, dont add if we already have it

        if(DB::table('roman_numerals')->where('value', $roman)->first()){
            return redirect()->route('numbers.index')->with('integerValue', $integerValue);
        }

        if($integerValue){
            $newNumber = new Numbers;
            $newNumber->value = $integerValue; 
            $newNumber->save(); 

            $newroman = new RomanNumeral; 
            $newroman->number_id = $newNumber->id;
            $newroman->value = $roman;
            $newroman->save();
        }
        return redirect()->route('numbers.index')->with('integerValue', $integerValue);
    }
    public static function numberToRoman($num) {
        $romans = [
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
        

        $result = '';
        foreach ($romans as $key => $value) {
            $matches = intval($num / $value);
            $result .= str_repeat($key, $matches);
            $num = $num % $value;
        }

        return $result;
    }

    private function romanToNumber($roman) {
        $romans = [
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
    
        $result = 0;
        $i = 0;
    
        while ($roman != '' && $i < strlen($roman)) {
            //we assume groups of two
            $twoChar = substr($roman, $i, 2);
            //lets see if they are actually roman characters
            if (array_key_exists($twoChar, $romans)) {
                $result += $romans[$twoChar];
                $i += 2;
                continue;
            }
            //maybe its just a single roman numeral
            $oneChar = $roman[$i];
            if (array_key_exists($oneChar, $romans)) {
                $result += $romans[$oneChar];
                $i++;
            } else {
                //Non existent value
                $result = 'NOT VALID';
                break;
            }
        }
    
        return $result;
    }

}
