<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dimension;
use App\Models\Indicator;
use App\Models\Question;
use App\Models\Response;
use App\Models\Answer;

class AnswerController extends Controller
{
    //
    public function searchAnswer($response, Request $request){
        $query = $request->input("query");
        $dimensionId = $request->input("dimensionId");
        $indicatorId = $request->input("indicatorId");

        $response = Response::find($response);

        $answers = Answer::join('questions', 'questions.id', "=", 'answers.question_id')
            ->join('indicators', 'indicators.id', "=", 'questions.indicator_id')
            ->join('dimensions', 'dimensions.id', "=", 'indicators.dimension_id')
            ->where('response_id', $response->id)
            ->where('questions.name', 'LIKE', '%'.$query.'%');
            
        if($dimensionId != 0){
            $answers = $answers->where('dimensions.id', "=", $dimensionId);
        }

        if($indicatorId != 0){
            $answers = $answers->where('indicators.id', "=", $indicatorId);
        }

        $answers = $answers->select('answers.*', 'questions.name as question_name', 
        'dimensions.name as dimension_name', 'indicators.name as indicator_name', 'questions.leftmost_parameter', 'questions.rightmost_parameter')
        ->paginate(10);
        
        return response()->json(["answers" => $answers]); 
    }
}
