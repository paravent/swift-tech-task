<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RomanNumeral extends Model
{
    use HasFactory;

    public function number() {
        return $this->belongsTo(Numbers::class);
    }
    
}
