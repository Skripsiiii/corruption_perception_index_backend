<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    function indicator(){
        return $this->belongsTo(Indicator::class);
    }

    function answers(){
        return $this->hasMany(Answer::class);
    }
}
