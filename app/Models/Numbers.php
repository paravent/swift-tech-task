<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Numbers extends Model
{
    use HasFactory;

    public function romanNumeral() {
        //one to one
        return $this->hasOne(RomanNumeral::class);
    }
}
