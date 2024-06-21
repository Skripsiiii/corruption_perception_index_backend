<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Questionnaire;
use App\Models\Dimension;
use App\Models\Indicator;
use App\Models\Question;
use App\Models\Response;
use App\Models\Answer;
use App\Models\IndicatorResult;
use App\Models\DimensionResult;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;

class QuestionnaireController extends Controller
{
    //
    public function show($questionnaire){
        $questionnaire = Questionnaire::where("year", "=", $questionnaire)->first();
        // $a = $questionnaire->dimensions[1];
        // $a = Dimension::with('indicators')->find($$questionnaire->dimensions[0]->id);
        // dd($a->id);
        return view('admin.questionnaire', ["questionnaire" => $questionnaire]);
    }

    public function questionnaire_history(){
        $unfinished_responses = Response::join("cities", "cities.id", "=", "responses.city_id")
        ->join("questionnaires", "questionnaires.id", "=", "responses.questionnaire_id")
        ->join('dimensions', 'questionnaires.id', "=", 'dimensions.questionnaire_id')
        ->join('indicators', 'dimensions.id', "=", 'indicators.dimension_id')
        ->join('questions', 'indicators.id', "=", 'questions.indicator_id')
        ->selectRaw("responses.id as response_id, questionnaires.year as year,
                    cities.name as name,
                    cities.id as city_id,
                    questionnaires.id as questionnaire_id,
                    count(questions.id) as total_questions
                    ")
        ->where("user_id", "=", Auth()->user()->id)
        ->where("corruption_index", "=", null)
        ->groupBy("responses.id", "questionnaires.year", "cities.name", "cities.id", "questionnaires.id")
        ->get();

        $finished_responses = Response::join("cities", "cities.id", "=", "responses.city_id")
        ->join("questionnaires", "questionnaires.id", "=", "responses.questionnaire_id")
        ->select("responses.id as response_id", "questionnaires.year as year",
        "cities.name as name",
        "cities.id as city_id",
        "responses.updated_at as finished_at",
        "questionnaires.id as questionnaire_id",
        "responses.corruption_index as corruption_index"
        )
        ->where("user_id", "=", Auth()->user()->id)
        ->where("corruption_index", "!=", null)
        ->get();

        return view("user.questionnaireHistory", ["unfinished_responses" => $unfinished_responses, "finished_responses" => $finished_responses]);
    }

    public function questionnaire_history_app(){
        $unfinished_responses = Response::join("cities", "cities.id", "=", "responses.city_id")
        ->join("questionnaires", "questionnaires.id", "=", "responses.questionnaire_id")
        ->join('dimensions', 'questionnaires.id', "=", 'dimensions.questionnaire_id')
        ->join('indicators', 'dimensions.id', "=", 'indicators.dimension_id')
        ->join('questions', 'indicators.id', "=", 'questions.indicator_id')
        ->selectRaw("responses.id as response_id, questionnaires.year as year,
                    cities.name as name,
                    cities.id as city_id,
                    questionnaires.id as questionnaire_id,
                    count(questions.id) as total_questions
                    ")
        ->where("user_id", "=", Auth()->user()->id)
        ->where("corruption_index", "=", null)
        ->groupBy("responses.id", "questionnaires.year", "cities.name", "cities.id", "questionnaires.id")
        ->get();

        $finished_responses = Response::join("cities", "cities.id", "=", "responses.city_id")
        ->join("questionnaires", "questionnaires.id", "=", "responses.questionnaire_id")
        ->select("responses.id as response_id", "questionnaires.year as year",
        "cities.name as name",
        "cities.id as city_id",
        "responses.updated_at as finished_at",
        "questionnaires.id as questionnaire_id",
        "responses.corruption_index as corruption_index"
        )
        ->where("user_id", "=", Auth()->user()->id)
        ->where("corruption_index", "!=", null)
        ->get();

        return response()->json(['unfinished_responses' => $unfinished_responses, 'finished_responses' => $finished_responses]);
    }

    public function updateChosenIndicator(Request $request){
        $id = $request->input("indicator_id");
        $indicator = Indicator::find($id);
        return response()->json(['indicator_chosen' => $indicator, 'questions' => $indicator->questions]);
    }

    public function store(Request $request){

        $validation = [
            'questionnaireYear' => ['required', 'integer', 'min:2000', 'unique:questionnaires,year'],
        ];

        $validator = Validator::make($request->all(), $validation);

        if($validator->fails()){
            return response()->json(["error" => $validator->errors()]);
        }

        $questionnaireYear = $request->input("questionnaireYear");
        if($request->input("copy") == "false"){
            $newQuestionnaire = new Questionnaire;
            $newQuestionnaire->year = $questionnaireYear;
            $newQuestionnaire->save();
        }
        else{
            $latestQuestionnaire = Questionnaire::latest()->first();
            $newQuestionnaire = $latestQuestionnaire->replicate();
            $newQuestionnaire->year = $questionnaireYear;
            $newQuestionnaire->push();
            foreach ($latestQuestionnaire->dimensions as $dimension) {
                $copy = $dimension->replicate();
                $newQuestionnaire->dimensions()->save($copy);

                foreach ($dimension->indicators as $indicator) {
                    $indicatorCopy = $indicator->replicate();
                    $copy->indicators()->save($indicatorCopy);

                    foreach ($indicator->questions as $question) {
                        $questionCopy = $question->replicate();
                        $indicatorCopy->questions()->save($questionCopy);
                    }
                }
            }
        }

        session()->flash('success', "Successfully Create New Questionnaire");
        return response()->json(["success" => $request->input("copy")]);
    }

    public function prev_questions(Request $request){

        $questionnaire = Questionnaire::find($request->questionnaire);

        $city = $request->city;

        $user_id = Auth()->user()->id;

        $response = Response::where("city_id", "=", intval($city))
        ->where("user_id", "=", $user_id)->where("questionnaire_id", "=", $questionnaire->id)->first();

        $answers = $request->answers;

        foreach($answers as $question_id => $value){
            if($question_id == 0){
                continue;
            }

            $answer = Answer::where("response_id", "=", $response->id)->where("question_id", "=", $question_id)->first();

            if($answer == null){
                $answer = new Answer();
                $answer->response_id = $response->id;
                $answer->question_id = $question_id;
                $answer->answer_key = intval($value);
            }

            $answer->answer_key = intval($value);
            $answer->save();

        }

        $currentDimensionId = $request->dimension;
        $dimension = Dimension::find($currentDimensionId);
        $dimension_number = intval(substr($dimension->dimension_number,4));

        $currentIndicatorId = $request->indicator;
        $indicator = Indicator::find($currentIndicatorId);
        $indicator_number = intval(substr($indicator->indicator_number,4));

        $currentQuestionNumber = $request->question_number;

        // validasi mundur indikator dan mundur dimension
        if($currentQuestionNumber <= 5){

            // kalau udah di IND_1, harus mundur dimension
            if($indicator_number <= 1){
                $dimension_number -= 1;
                $dimension = Dimension::where("questionnaire_id", "=", $questionnaire->id)
                ->where("dimension_number", "=", "DIM_" . $dimension_number)->first();
                $currentDimensionId = $dimension->id;

                $max_indicator_number = Indicator::selectRaw('MAX(CAST(SUBSTRING_INDEX(indicator_number, "_", -1) AS UNSIGNED)) AS max_indicator_number')->where("dimension_id", $currentDimensionId)->first()->max_indicator_number;

                $indicator_number = $max_indicator_number;
                $indicator = Indicator::where("dimension_id", "=", $currentDimensionId)
                ->where("indicator_number", "=", "IND_" . $indicator_number)->first();
                $currentIndicatorId = $indicator->id;
            }
            else{
                // kalau belum IND_1, mundur indicator-nya aja
                $indicator_number -= 1;
                $indicator = Indicator::where("dimension_id", "=", $currentDimensionId)
                ->where("indicator_number", "=", "IND_" . $indicator_number)->first();
                $currentIndicatorId = $indicator->id;
            }

            // max question_number di indicator tsb.
            $currentQuestionNumber = Question::selectRaw("MAX(question_number) AS max_question_number")->where("indicator_id", $currentIndicatorId)->first()->max_question_number + 5;

            // return response()->json(["success" => $currentQuestionNumber]);

            // $currentQuestionNumber = Question::where("indicator_id", $currentIndicatorId)->orderBy("question_number", "desc")->first()->question_number;
        }


        if($currentQuestionNumber < 5){
            $questions = Question::where("indicator_id", $currentIndicatorId)
            ->leftJoin("answers", "answers.question_id", "=", "questions.id")
            ->where("answers.response_id", "=", $response->id)
            ->whereBetween("question_number", [1, $currentQuestionNumber])
            ->select("questions.*", "answers.answer_key")
            ->get();
        }
        else if ($currentQuestionNumber % 5 == 0){
            $mod = $currentQuestionNumber % 5;
            $questions = Question::where("indicator_id", $currentIndicatorId)
            ->leftJoin("answers", "answers.question_id", "=", "questions.id")
            ->where("answers.response_id", "=", $response->id)
            ->whereBetween("question_number", [$currentQuestionNumber - 5 - 4, $currentQuestionNumber - 5])
            ->select("questions.*", "answers.answer_key")
            ->get();

        }
        else{
            $mod = $currentQuestionNumber % 5;
            $questions = Question::where("indicator_id", $currentIndicatorId)
            ->leftJoin("answers", "answers.question_id", "=", "questions.id")
            ->where("answers.response_id", "=", $response->id)
            ->whereBetween("question_number", [$currentQuestionNumber - 5 - $mod + 1, $currentQuestionNumber - 5 - $mod + 1 + 4])
            ->select("questions.*", "answers.answer_key")
            ->get();
        }

        $total_questions = Question::join('indicators', 'indicators.id', "=", 'questions.indicator_id')
        ->join('dimensions', 'dimensions.id', "=", 'indicators.dimension_id')
        ->where('dimensions.questionnaire_id', "=", $questionnaire->id)->get()->count();

        $answered_questions = Answer::join('responses', 'responses.id', "=", "answers.response_id")
        ->where('responses.id', "=", $response->id)
        ->where('responses.questionnaire_id', "=", $questionnaire->id)->get()->count();

        return response()->json(["questionnaire" => $questionnaire, "city" => $city, "dimension" => $dimension, "dimension_number" => $dimension_number, "indicator" => $indicator, "indicator_number" => $indicator_number , "questions" => $questions, "question_number" => $currentQuestionNumber, "total_questions" => $total_questions, "answered_questions" => $answered_questions]);
    }

    public function next_data(Request $request){
        $questionnaire = Questionnaire::find($request->questionnaire);

        $answers = $request->answers;

        $city = $request->city;

        $user_id = Auth()->user()->id;

        $response = Response::where("city_id", "=", intval($city))
        ->where("user_id", "=", $user_id)->where("questionnaire_id", "=", $questionnaire->id)->first();

        $currentDimensionId = $request->dimension;
        $dimension = Dimension::find($currentDimensionId);
        $dimension_number = substr($dimension->dimension_number,4);

        $currentIndicatorId = $request->indicator;
        $indicator = Indicator::find($currentIndicatorId);
        $indicator_number = substr($indicator->indicator_number,4);

        $currentQuestionNumber = $request->question_number;

        $max_question_number = Question::selectRaw("MAX(question_number) AS max_question_number")->where("indicator_id", $request->indicator)->first()->max_question_number;

        if($currentQuestionNumber >= $max_question_number){

            $max_indicator_number = Indicator::selectRaw('MAX(CAST(SUBSTRING_INDEX(indicator_number, "_", -1) AS UNSIGNED)) AS max_indicator_number')->where("dimension_id", $request->dimension)->first()->max_indicator_number;


            if($indicator_number >= $max_indicator_number){
                $max_dimension_number = Dimension::selectRaw('MAX(CAST(SUBSTRING_INDEX(dimension_number, "_", -1) AS UNSIGNED)) AS max_dimension_number')->where("questionnaire_id", $request->questionnaire)->first()->max_dimension_number;

                if($dimension_number >= $max_dimension_number){

                    $data = ['response_id' => $response->id];

                    $request = new Request();
                    $request->merge($data);

                    return $this->calculate($request);
                }

                else{
                    $dimension_number += 1;
                    $dimension = Dimension::where("questionnaire_id", $request->questionnaire)->where("dimension_number", "DIM_" . $dimension_number)->first();
                    $currentDimensionId = $dimension->id;
                    $indicator_number = 1;
                    $indicator = Indicator::where("dimension_id", $dimension->id)->where("indicator_number", "IND_" . $indicator_number)->first();
                    $currentIndicatorId = $indicator->id;
                }

            }
            else{
                $indicator_number += 1;
                $indicator = Indicator::where("dimension_id", $currentDimensionId)->where("indicator_number", "IND_" . $indicator_number)->first();
                $currentIndicatorId = $indicator->id;

            }

            $currentQuestionNumber = 0;
        }

        $questions = Question::where("indicator_id", $currentIndicatorId)
            ->leftJoin("answers", "answers.question_id", "=", "questions.id")
            ->where("answers.response_id", "=", $response->id)
            ->whereBetween("question_number", [$currentQuestionNumber+1, $currentQuestionNumber+5])
            ->select("questions.*", "answers.answer_key")
            ->get();

            $questions = Question::where("indicator_id", $currentIndicatorId)
            ->leftJoin("answers", function ($join) use ($response) {
                $join->on("answers.question_id", "=", "questions.id")
                     ->where("answers.response_id", "=", $response->id);
            })
            ->whereBetween("question_number", [$currentQuestionNumber+1, $currentQuestionNumber+5])
            ->select("questions.*", "answers.answer_key")
            ->get();

        $total_questions = Question::join('indicators', 'indicators.id', "=", 'questions.indicator_id')
        ->join('dimensions', 'dimensions.id', "=", 'indicators.dimension_id')
        ->where('dimensions.questionnaire_id', "=", $questionnaire->id)->get()->count();

        $answered_questions = Answer::join('responses', 'responses.id', "=", "answers.response_id")
        ->where('responses.id', "=", $response->id)
        ->where('responses.questionnaire_id', "=", $questionnaire->id)->get()->count();

        return ["questionnaire" => $questionnaire, "city" => $city , "dimension" => $dimension, "dimension_number" => $dimension_number, "indicator" => $indicator, "indicator_number" => $indicator_number, "questions" => $questions, "question_number" => $currentQuestionNumber+$questions->count(), "total_questions" => $total_questions, "answered_questions" => $answered_questions];
    }

    public function next_questions(Request $request){
        $questionnaire = Questionnaire::find($request->questionnaire);

        $answers = $request->answers;
        $city = $request->city;

        $user_id = Auth()->user()->id;

        // save answers

        $response = Response::where("city_id", "=", intval($city))
        ->where("user_id", "=", $user_id)->where("questionnaire_id", "=", $questionnaire->id)->first();

        if($response == null){
            $response = new Response();
            $response->city_id = $city_id;
            $response->user_id = $user_id;
            $response->questionnaire_id = $questionnaire->id;
            $response->corruption_index = null;
            $response->save();
        }

        foreach($answers as $question_id => $value){
            if($question_id == 0){
                continue;
            }

            $answer = Answer::where("response_id", "=", $response->id)->where("question_id", "=", $question_id)->first();

            if($answer == null){
                $answer = new Answer();
                $answer->response_id = $response->id;
                $answer->question_id = $question_id;
                $answer->answer_key = intval($value);
            }

            $answer->answer_key = intval($value);
            $answer->save();

        }

        // ke next questions
        return response()->json($this->next_data($request));
    }

    public function user_show($year, $city){

        $questionnaire = Questionnaire::where("year", "=", intval($year))->first();

        $user_id = Auth()->user()->id;

        $response = Response::where("city_id", "=", intval($city))
        ->where("user_id", "=", $user_id)->where("questionnaire_id", "=", $questionnaire->id)->first();

        if($response == null){
            $response = new Response();
            $response->city_id = $city;
            $response->user_id = $user_id;
            $response->questionnaire_id = $questionnaire->id;
            $response->corruption_index = null;
            $response->save();
        }

        $currentDimensionId = Dimension::where("questionnaire_id", "=", $questionnaire->id)->orderBy("dimension_number", "asc")->first()->id;

        $currentIndicatorId = Indicator::where("dimension_id", "=", $currentDimensionId)->orderBy("indicator_number", "asc")->first()->id;
        $currentQuestionNumber = 0;

        $answered = Question::join("answers", "questions.id", "=", "answers.question_id")
            ->where("response_id", "=", $response->id)->orderBy("indicator_id", "desc")->orderBy("question_number", "desc")->first();

        if($answered != null){
            $currentIndicatorId = $answered->indicator_id;
            $currentDimensionId = Indicator::find($currentIndicatorId)->dimension_id;
            $currentQuestionNumber = $answered->question_number;
        }

        $data = ['questionnaire' => $questionnaire->id,
            'dimension' => $currentDimensionId,
            'indicator' => $currentIndicatorId,
            'question_number' => $currentQuestionNumber,
            'city' => $city
        ];

        $request = new Request();
        $request->merge($data);

        $result = $this->next_data($request);

        return view("user.questionnaire", $result);
    }

    public function check_user_questionnaire(Request $request){

        $year = $request->year;
        $city_id = $request->city;

        $questionnaire = Questionnaire::where("year", "=", intval($year))->first();

        $response = Response::where("user_id", "=", Auth()->user()->id)->where("city_id", "=", $city_id)
        ->where("questionnaire_id", "=", $questionnaire->id)->first();

        if($response == null){
            $response = new Response();
            $response->user_id = Auth()->user()->id;
            $response->city_id = $city_id;
            $response->questionnaire_id = $questionnaire->id;
            $response->corruption_index = null;
            $response->save();
        }

        return response()->json(["success" => true]);
    }

    // public function user_show_option(){
    //     $responses = Response::join("cities", "cities.id", "=", "responses.city_id")
    //     ->join("questionnaires", "questionnaires.id", "=", "responses.questionnaire_id")
    //     ->select("responses.id as response_id", "questionnaires.year as year",
    //     "cities.name as name",
    //     "cities.id as city_id",
    //     "questionnaires.id as questionnaire_id")
    //     ->where("user_id", "=", Auth()->user()->id)
    //     ->get();

    //     return view("user.questionnaireOption", ["responses" => $responses]);
    // }

    public function user_show_option()
    {
        $responses = Response::join("cities", "cities.id", "=", "responses.city_id")
            ->join("questionnaires", "questionnaires.id", "=", "responses.questionnaire_id")
            ->select(
                "responses.id as response_id",
                "questionnaires.year as year",
                "cities.name as name",
                "cities.id as city_id",
                "questionnaires.id as questionnaire_id"
            )
            ->where("user_id", "=", Auth::user()->id)
            ->get();

        return response()->json(["responses" => $responses]);
    }


    public function checkQuestionnaireArea(Request $request){

        $questionnaire = Questionnaire::where("year", "=", $request->input("year"))->first();

        $response = Response::where("questionnaire_id", "=", $questionnaire->id)
            ->where("user_id", "=", Auth()->user()->id)
            ->where("city_id", "=", $request->input("city"))->first();

        if($response != null){

            return response()->json(
                ["error" => "You have already respond for this city. Continue unfinished questionnaire or choose another city.",]);
        }
        else{
            return response()->json(['response' => "aaa"]);
        }

        return response()->json(['response' => $response]);
    }

    public function calculate(Request $request){
        $response = Response::find($request->response_id);
        $questionnaire = Questionnaire::find($response->questionnaire_id);

        $dimensions = Dimension::where("questionnaire_id", $questionnaire->id)->get();

        foreach($dimensions as $dimension){

            foreach($dimension->indicators as $indicator){
                //new indicator
                $newIndicatorResult = new IndicatorResult();
                $newIndicatorResult->response_id = $response->id;
                $newIndicatorResult->indicator_id = $indicator->id;

                $avg_answer = Answer::join("questions", "questions.id", "=", "answers.question_id")
                ->where("indicator_id", $indicator->id)
                ->where("response_id", "=", $response->id)
                ->avg('answer_key');

                $newIndicatorResult->corruption_index = $avg_answer;
                $newIndicatorResult->save();
                //end new indicator               
            }

            $newDimensionResult = new DimensionResult();
            $newDimensionResult->response_id = $response->id;
            $newDimensionResult->dimension_id = $dimension->id;

            $avg_indicator = IndicatorResult::join("indicators", "indicators.id", "=", "indicator_results.indicator_id")
            ->where("dimension_id", "=", $dimension->id)->avg("corruption_index");


            $newDimensionResult->corruption_index = $avg_indicator;
            $newDimensionResult->save();
        }

        $avg_dimension = DimensionResult::join("dimensions", "dimensions.id", "=", "dimension_results.dimension_id")
        ->where("questionnaire_id", "=", $response->questionnaire_id)->avg("corruption_index");

        $response->corruption_index = $avg_dimension * 10;
        $response->save();

        session()->flash('success', "Thank you for you submission! CPI Score: " . ($avg_dimension * 10));

        // return response()->json(['score' => $data->prediction[0]]);

        // masi dummy blm call api
        return ["score" => $avg_dimension * 10];

    }

    public function user_store(Request $request){

        // $answers = json_decode(collect($request->input("answers")));
        $answers = json_decode($request->input("answers"));
        // $answers = collect($request->input("answers"));

        $questionnaire = Questionnaire::find($request->input("questionnaireId"));

        $newResponse = new Response;
        $newResponse->user_id = Auth()->user()->id;
        $newResponse->city_id = $request->input("questionnaireCity");

        $newResponse->questionnaire_id = $questionnaire->id;
        $questionnaire_index = 0;

        $newResponse->corruption_index = $questionnaire_index;
        $newResponse->save();

        foreach($questionnaire->dimensions as $dimension){
            $dimension_index = 0;
            foreach($dimension->indicators as $indicator){
                $indicator_index = 0;
                foreach(Question::where("indicator_id", $indicator->id)->get() as $question){
                    $newAnswer = new Answer;
                    $newAnswer->response_id = $newResponse->id;
                    $answer = collect($answers)->firstWhere('questionId', $question->id);
                    $newAnswer->question_id = $question->id;
                    $newAnswer->answer_key = $answer->answerKey;
                    $newAnswer->save();

                    $indicator_index += $answer->answerKey; //call api
                }
                $indicator_index /= $indicator->questions->count();

                $newIndicatorResult = new IndicatorResult;
                $newIndicatorResult->response_id = $newResponse->id;
                $newIndicatorResult->indicator_id = $indicator->id;
                $newIndicatorResult->corruption_index = $indicator_index;
                $newIndicatorResult->save();

                $dimension_index += $indicator_index;
            }
            $dimension_index /= $dimension->indicators->count();

            $newDimensionResult = new DimensionResult;
            $newDimensionResult->response_id = $newResponse->id;
            $newDimensionResult->dimension_id = $dimension->id;

            $newDimensionResult->corruption_index = $dimension_index;
            $newDimensionResult->save();

            $questionnaire_index += $dimension_index;
        }

        $questionnaire_index /= $questionnaire->dimensions->count();

        $url = 'http://localhost:5000/api/submit_data';
        $data = [];
        for ($i = 0; $i < $questionnaire->dimensions->count(); $i++) {
            $questionKey = 'pertanyaan' . ($i + 1);
            $corruptionIndex = $newResponse->dimensionResults->get($i)->corruption_index;

            $data[$questionKey] = $corruptionIndex;
        }
        $response = Http::post($url, $data);

        $data = json_decode($response->body());

        $newResponse->corruption_index = $data->prediction[0];
        $newResponse->save();

        session()->flash('success', "Thank you for you submission! CPI Score: " . $data->prediction[0]);
        return response()->json(['score' => $data->prediction[0]]);
    }

    public function user_show_app($year, $city){

        $questionnaire = Questionnaire::where("year", "=", intval($year))->first();

        $user_id = Auth()->user()->id;

        $response = Response::where("city_id", "=", intval($city))
        ->where("user_id", "=", $user_id)->where("questionnaire_id", "=", $questionnaire->id)->first();

        if($response == null){
            $response = new Response();
            $response->city_id = $city;
            $response->user_id = $user_id;
            $response->questionnaire_id = $questionnaire->id;
            $response->corruption_index = null;
            $response->save();
        }

        $currentDimensionId = Dimension::where("questionnaire_id", "=", $questionnaire->id)->orderBy("dimension_number", "asc")->first()->id;

        $currentIndicatorId = Indicator::where("dimension_id", "=", $currentDimensionId)->orderBy("indicator_number", "asc")->first()->id;
        $currentQuestionNumber = 0;

        $answered = Question::join("answers", "questions.id", "=", "answers.question_id")
            ->where("response_id", "=", $response->id)->orderBy("indicator_id", "desc")->orderBy("question_number", "desc")->first();

        if($answered != null){
            $currentIndicatorId = $answered->indicator_id;
            $currentDimensionId = Indicator::find($currentIndicatorId)->dimension_id;
            $currentQuestionNumber = $answered->question_number;
        }

        $data = ['questionnaire' => $questionnaire->id,
            'dimension' => $currentDimensionId,
            'indicator' => $currentIndicatorId,
            'question_number' => $currentQuestionNumber,
            'city' => $city
        ];

        $request = new Request();
        $request->merge($data);

        $result = $this->next_data($request);

        return response()->json(['result' => $result]);
    }
}
