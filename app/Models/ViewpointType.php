<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewpointType extends Model
{
    use HasFactory;

    function viewpoints(){
        return $this->hasMany(Viewpoint::class);
    }
}
