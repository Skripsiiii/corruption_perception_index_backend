<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Questionnaire;
use App\Models\Indicator;
use App\Models\Dimension;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class QuestionController extends Controller
{
    //

    public function show($questionnaire){
        $questionnaire = Questionnaire::where("year", "=", $questionnaire)->first();

        $data = [
            "questionnaire" => $questionnaire
        ];

        return view("admin.questions", $data);
    }

    public function store(Request $request){
        $validation = [
            'questionName' => ['required'],
            'leftmostParameter' => ['required'],
            'rightmostParameter' => ['required'],
        ];

        $validator = Validator::make($request->all(), $validation);

        if($validator->fails()){
            return response()->json(["error" => $validator->errors()]);
        }

        $indicatorId = $request->input("indicatorId");
        $questionName = $request->input("questionName");
        $leftmost = $request->input("leftmostParameter");
        $rightmost = $request->input("rightmostParameter");

        $max_question_number = Question::selectRaw("MAX(question_number) AS max_question_number")->where("indicator_id", $indicatorId)->first()->max_question_number;

        $newQuestion = new Question;
        $newQuestion->indicator_id = $indicatorId;
        $newQuestion->name = $questionName;
        $newQuestion->question_number = $max_question_number + 1;
        $newQuestion->leftmost_parameter = $leftmost;
        $newQuestion->rightmost_parameter = $rightmost;
        $newQuestion->save();

        session()->flash('success', "Successfully create New Question");
        return response()->json(["success" => "Successfully create new question"]);
    }

    public function update($id, Request $request){
        $validation = [
            'questionName' => ['required'],
            'leftmostParameter' => ['required'],
            'rightmostParameter' => ['required'],
        ];

        $validator = Validator::make($request->all(), $validation);

        if($validator->fails()){
            return response()->json(["error" => $validator->errors()]);
        }

        $questionName = $request->input("questionName");
        $leftmost = $request->input("leftmostParameter");
        $rightmost = $request->input("rightmostParameter");

        $question = Question::find($id);
        $question->name = $questionName;
        $question->leftmost_parameter = $leftmost;
        $question->rightmost_parameter = $rightmost;
        $question->save();

        session()->flash('success', "Successfully Edit Question");
        return response()->json(["success" => "Successfully Edit Question"]);
    }

    public function destroy($question){
        Question::destroy($question);
        return redirect()->back()->with("success", "Successfully Delete Question");
    }

    public function searchQuestion($questionnaire, Request $request){
        $query = $request->input("query");
        $dimensionId = $request->input("dimensionId");
        $indicatorId = $request->input("indicatorId");

        $questions = Question::join('indicators', 'indicators.id', "=", 'questions.indicator_id')
        ->join('dimensions', 'dimensions.id', "=", 'indicators.dimension_id')
        ->join('questionnaires', 'questionnaires.id', "=", "dimensions.questionnaire_id")
        ->where('questionnaires.id', "=", $questionnaire)
        ->where('questions.name', 'LIKE', '%'.$query.'%');
            
        if($dimensionId != 0){
            $questions = $questions->where('dimensions.id', "=", $dimensionId);
        }

        if($indicatorId != 0){
            $questions = $questions->where('indicators.id', "=", $indicatorId);
        }

        $questions = $questions->select('questions.*', 'dimensions.name as dimension_name', 'indicators.name as indicator_name')->get();
        
        return response()->json(["questions" => $questions]);
    }
}
