<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    function province(){
        return $this->belongsTo(Province::class);
    }

    function domiciles(){
        return $this->hasMany(Domicile::class);
    }

    function users(){
        return $this->hasManyThrough(User::class, Domicile::class, 'city_id', 'id', 'id', 'participant_id');
    }

    function responses(){
        return $this->hasMany(Response::class);
    }
}
