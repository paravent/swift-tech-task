<?php

namespace App\Http\Controllers;

use App\Models\RomanNumeral;
use Illuminate\Http\Request;
use App\Models\Numbers;
use Illuminate\Support\Facades\DB;
use App\Services\RomanNumeralService;

class RomanNumeralController extends Controller
{
    protected $romanNumeralService;

    public function __construct(RomanNumeralService $romanNumeralService)
    {
        $this->romanNumeralService = $romanNumeralService;
    }

    public function convertTo(Request $request)
    {
        $number = $request->input('number');

        if($number < 1 || $number > 100000) {
            return redirect()->back()->withErrors(['error' => 'Invalid number provided.']);
        }

        $romanNumeral = $this->romanNumeralService->numberToRoman($number);

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

        $integerValue = $this->romanNumeralService->romanToNumber($roman);
        //db support for extra features, dont add if we already have it
        if(!$integerValue) {
            return redirect()->back()->withErrors(['error' => 'Please provide a Roman numeral.']);
        }

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
}
