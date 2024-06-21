<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DimensionResult extends Model
{
    use HasFactory;
    protected $primaryKey = ['response_id','dimension_id'];
    public $incrementing = false;
    function response(){
        return $this->belongsTo(Response::class);
    }

    function dimension(){
        return $this->belongsTo(Dimension::class);
    }
}
