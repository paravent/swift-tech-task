<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NumbersController;
use App\Http\Controllers\RomanNumeralController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/numbers', NumbersController::class .'@index')->name('numbers.index');
Route::post('/convertTo', [RomanNumeralController::class, 'convertTo'])->name('convertToRoman');
Route::post('/convertFrom', [RomanNumeralController::class, 'convertFrom'])->name('convertFromRoman');

