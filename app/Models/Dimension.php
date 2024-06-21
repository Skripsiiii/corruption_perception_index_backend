<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dimension extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $casts = [
        'cpi_score' => 'float',
    ];


    function questionnaire(){
        return $this->belongsTo(Questionnaire::class);
    }

    function indicators(){
        return $this->hasMany(Indicator::class, "dimension_id");
    }

    function dimensionResults(){
        return $this->hasMany(DimensionResult::class);
    }
}
