<?php

namespace App\Http\Controllers;

use App\Models\Occupation;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OccupationController extends Controller
{
    public function getOccupation(){
        $occupation = Occupation::all();
        return response()->json([
            "data" => $occupation
        ],Response::HTTP_OK);
    }
}
