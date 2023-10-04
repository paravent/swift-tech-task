<?php

namespace App\Http\Controllers;
use App\Models\Numbers;
use Illuminate\Http\Request;

class NumbersController extends Controller
{
    public function index() {


        $numbers = Numbers::all();
        return view('numbers.index', compact('numbers'));


    }
}
