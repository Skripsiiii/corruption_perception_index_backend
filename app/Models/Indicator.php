<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indicator extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    function dimension(){
        return $this->belongsTo(Dimension::class, "dimension_id", "id");
    }

    function questions(){
        return $this->hasMany(Question::class);
    }

    function indicatorResults(){
        return $this->hasMany(IndicatorResult::class);
    }
}
