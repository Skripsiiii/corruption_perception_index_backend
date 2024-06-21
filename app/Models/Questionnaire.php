<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model
{
    use HasFactory;

    function dimensions(){
        return $this->hasMany(Dimension::class);
    }

    function responses(){
        return $this->hasMany(Response::class);
    }
}
