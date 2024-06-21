<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domicile extends Model
{
    use HasFactory;
    
    protected $primaryKey = ['user_id', 'city_id', 'start_date'];
    protected $casts = [
        "user_id" => "int",
        "city_id" => "int",
        "start_date" => "date",
    ];

    public $incrementing = false;

    function user(){
        return $this->belongsTo(User::class);
    }

    function city(){
        return $this->belongsTo(City::class);
    }

    public function scopeByCompositeKey($query, $user_id, $city_id, $start_date){
        return $query->where('user_id', $user_id)
            ->where('city_id', $city_id)
            ->where('start_date', $start_date);
    }

}
