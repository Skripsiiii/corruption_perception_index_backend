<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EducationController extends Controller
{
    public function getEducation(){
        $education = Education::all();
        return response()->json([
            "data" => $education
        ],Response::HTTP_OK);
    }
}
