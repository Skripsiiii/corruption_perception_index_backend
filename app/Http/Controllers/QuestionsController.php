<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Dimension;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class QuestionsController extends Controller
{
    // public function getQuestion(){
    //     return response()->json([
    //         "data" => Question::all(),
    //     ],Response::HTTP_OK);
    // }

    public function getQuestion()
    {
        $data = Dimension::with('indicators.questions')->get();

        return response()->json([
            'data' => $data,
        ], Response::HTTP_OK);
    }
}
