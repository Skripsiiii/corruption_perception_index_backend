<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Viewpoint extends Model
{
    use HasFactory;
    protected $casts = [
        "user_id" => "int",
        "viewpoint_type_id" => "int",
    ];

    protected $fillable = [
        'is_effective',
    ];

    public $incrementing = false;

    function viewpoint_type(){
        return $this->belongsTo(ViewpointType::class);
    }

    function user(){
        return $this->belongsTo(User::class);
    }
}
