<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    public $incrementing = true;
    function answers(){
        return $this->hasMany(Answer::class);
    }

    function questionnaire(){
        return $this->belongsTo(Questionnaire::class);
    }

    function city(){
        return $this->belongsTo(City::class);
    }

    function user(){
        return $this->belongsTo(User::class);
    }

    function dimensionResults(){
        return $this->hasMany(DimensionResult::class);
    }

    function indicatorResults(){
        return $this->hasMany(IndicatorResult::class);
    }
}
