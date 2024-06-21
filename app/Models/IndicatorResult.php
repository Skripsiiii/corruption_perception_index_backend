<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndicatorResult extends Model
{
    use HasFactory;
    protected $primaryKey = ['response_id','indicator_id'];
    public $incrementing = false;
    function response(){
        return $this->belongsTo(Response::class);
    }

    function indicator(){
        return $this->belongsTo(Indicator::class);
    }


}
