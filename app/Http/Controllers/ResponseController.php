<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;
use App\Models\Response;
use App\Models\Questionnaire;
use App\Models\Dimension;
use App\Models\DimensionResult;
use App\Models\Participant;
use App\Models\Province;
use App\Models\City;
use App\Models\Indicator;
use App\Models\IndicatorResult;
use App\Models\Question;

class ResponseController extends Controller
{
    //
    public function index()
    {
    }

    public function show($response)
    {
        $questionnaire = Questionnaire::where("year", "=", $response)->first();
        $cpi_score = round($questionnaire->responses()->avg('corruption_index'), 1);
        $dimensionGroup = $questionnaire->dimensions()->withAvg("dimensionResults as cpi_score", "corruption_index")->get()->pluck("cpi_score", "name");

        $responses = Response::where('questionnaire_id', $questionnaire->id)->where("corruption_index", "!=", null)->paginate(10);

        $data = [
            "questionnaire" => $questionnaire,
            "cpi_score" => $cpi_score,
            "dimensionGroup" => $dimensionGroup,
            "responses" => $responses,
        ];

        return view('admin.responses.responses', $data);
    }

    public function searchResponse($response, Request $request)
    {
        $query = $request->input("query");
        $provinceId = $request->input("provinceId");
        $cityId = $request->input("cityId");

        $questionnaire = Questionnaire::where("year", "=", $response)->first();

        $responses = Response::join('users', 'responses.user_id', '=', 'users.id')
            ->join('cities', 'responses.city_id', "=", 'cities.id')
            ->join('provinces', 'cities.province_id', "=", 'provinces.id')
            ->where('questionnaire_id', $questionnaire->id)
            ->where("corruption_index", "!=", null)
            ->where('users.name', 'LIKE', '%' . $query . '%');

        if ($provinceId != 0) {
            $responses = $responses->where('provinces.id', "=", $provinceId);
        }

        if ($cityId != 0) {
            $responses = $responses->where('cities.id', "=", $cityId);
        }

        $responses = $responses->select('responses.*', 'users.name as participant_name', 'cities.name as city_name', 'provinces.name as province_name')
            ->paginate(10);

        return response()->json(["responses" => $responses]);
    }

    public function showDetail($response, $id)
    {

        $response = Response::find($id);
        $answers = Answer::where("response_id", $id)->paginate(10);
        return view('admin.responses.response-detail', ["response" => $response , "answers" => $answers]);
    }

    public function calculateDimensionResult($response, Request $request)
    {
        $dimensionId = $request->input("dimensionId");

        if ($dimensionId == 0) {
            return response()->json(["dimension_cpi" => 0]);
        }

        $questionnaire = Questionnaire::find($response);

        $results = $questionnaire->responses()
            ->join("dimension_results", "responses.id", "=", "dimension_results.response_id")
            ->where("dimension_results.dimension_id", "=", $dimensionId)
            ->select("dimension_results.corruption_index");

        if ($results->count() == 0) {
            return response()->json(["dimension_cpi" => -1]);
        }

        $score = round($results->sum("dimension_results.corruption_index") / $results->count(), 2);

        return response()->json(["dimension_cpi" => $score]);
    }

    public function calculateProvinceResult($response, Request $request)
    {
        $provinceId = $request->input("provinceId");

        if ($provinceId == 0) {
            return response()->json(["province_cpi" => 0]);
        }

        $results = Questionnaire::find($response)->responses()
            ->join("cities", "cities.id", "=", "responses.city_id")
            ->join("provinces", "provinces.id", "=", "cities.province_id")
            ->where("provinces.id", "=", $provinceId)->select("responses.corruption_index");

        if ($results->count() == 0) {
            return response()->json(["province_cpi" => -1]);
        }

        $score = round($results->sum("responses.corruption_index") / $results->count(), 2);

        return response()->json(["province_cpi" => $score, "num_results" => $results->count()]);
    }


    public function destroy($response)
    {
        Response::destroy($response);
        return redirect()->back()->with("success", "Successfully Delete Response");
    }

    public function randomDataView()
    {
        return view("user.testingPage");
    }

    public function storeReponse(Request $request){
        $response = Response::find($request->response_id);
        $questionnaire = Questionnaire::find($response->questionnaire_id);
        dd($response);
    }

    public function responseStore(Request $request)
    {

        $cities = City::all();
        // dd($cities[$endNumber]);
        $questionnaire = Questionnaire::find($request->input("questionnaireId"));


        $question = Question::all();
        $questionCount = $question->count();
        $realAnswers = $request->answers;

        // response
        $newResponse = new Response();
        $newResponse->user_id = Auth()->user()->id;
        $newResponse->city_id = $request->input("questionnaireCity");
        $newResponse->questionnaire_id = $questionnaire->id;
        $newResponse->corruption_index = 0;
        $newResponse->save();
        // save response


        $dimensions = Dimension::all();
        $dimensionsCount = $dimensions->count();
        $indicators = Indicator::all();
        $indicatorsCount = $indicators->count();
        $items = Question::all();

        $dimensionArray = [];
        $dimensionArrayIndex = [];
        $indicatorArray = [];
        $indicatorArrayIndex = [];
// 1 2 3
        foreach ($dimensions as $dimension) {
            $dimensionArray[strtoupper($dimension['id'])] = 0;
            $dimensionArrayIndex[strtoupper($dimension['id'])] = 0;
        }


        foreach ($indicators as $indicator) {
            $indicatorArray[strtoupper($indicator['id'])] = 0;
            $indicatorArrayIndex[strtoupper($indicator['id'])] = 0;
        }

        for ($i = 0; $i < $questionCount; $i++) {
            $indicatorArrayIndex[strtoupper($items[$i]->indicator_id)] += 1;
            $indicatorArray[strtoupper($items[$i]->indicator_id)] += $realAnswers[$i+1];

            // new answer
            $newAnswer = new Answer();
            $newAnswer->response_id = $newResponse->id;
            $newAnswer->question_id = $i + 1;
            $newAnswer->answer_key = $realAnswers[$i+1];
            $newAnswer->save();
            //end new answer
        }

        for ($i = 0; $i < $indicatorsCount; $i++) {
            $indicatorArray[strtoupper($indicators[$i]->id)] =
                $indicatorArray[strtoupper($indicators[$i]->id)] / $indicatorArrayIndex[strtoupper($indicators[$i]->id)];
        }

        foreach ($indicators as $indicator) {
            // 1 indicator ada 5 pertanyaan
            // orgnya jawab 10 * 5 = 50
            // 50 / 5 = 10
            // 1 indicator, co = 10
            $dimensionArray[strtoupper($indicator->dimension_id)] += $indicatorArray[strtoupper($indicator->id)];
            $dimensionArrayIndex[strtoupper($indicator->dimension_id)] += 1;

            //new indicator
            $newIndicatorResult = new IndicatorResult();
            $newIndicatorResult->response_id = $newResponse->id;
            $newIndicatorResult->indicator_id = $indicator->id;
            $newIndicatorResult->corruption_index = $indicatorArray[strtoupper($indicator->id)];
            $newIndicatorResult->save();
            //end new indicator
        }

        foreach ($dimensions as $dimension) {
            $dimensionArray[strtoupper($dimension->id)] = $dimensionArray[strtoupper($dimension->id)] / $dimensionArrayIndex[strtoupper($dimension->id)];

            // new dimension
            $newDimensionResult = new DimensionResult();
            $newDimensionResult->response_id = $newResponse->id;
            $newDimensionResult->dimension_id = $dimension->id;

            $newDimensionResult->corruption_index = $dimensionArray[strtoupper($dimension->id)];
            $newDimensionResult->save();
            //end new dimension

        }
        $data = [];
        $i = 0;

        foreach ($dimensionArray as $dimensionResult) {
            $questionKey = 'pertanyaan' . ($i + 1);
            $data[$questionKey] = $dimensionResult;
            $i++;
        }

        $dimensionArrayTotal =  0;

        foreach ($dimensionArray as $dimension) {
            $dimensionArrayTotal = $dimensionArrayTotal + $dimension;
        }
        $dimensionArrayTotal = round((($dimensionArrayTotal / ($dimensionsCount * 10)) * 100), 2);

        // update
        $newResponse->corruption_index = $dimensionArrayTotal;
        $newResponse->save();
        // end update

        session()->flash('success', "Thank you for you submission! CPI Score: " . $dimensionArrayTotal);
        return response()->json(['score' => $dimensionArrayTotal]);
    }

    public function randomData($startNumber, $endNumber,$check)
    {
        $cities = City::all();
        // dd($cities[$endNumber]);



        for ($x = $startNumber; $x < $endNumber; $x++) {
            $question = Question::all();
            $questionCount = $question->count();
            $realAnswers = [];
            for ($i = 0; $i < $question->count(); $i++) {
                if($check == 1){
                    $realAnswers[$i] = rand(1, 2);
                }else if($check == 2){
                    $realAnswers[$i] = rand(3, 4);
                }
                else if($check == 3){
                    $realAnswers[$i] = rand(5, 6);
                }
                else if($check == 4){
                    $realAnswers[$i] = rand(7, 8);
                }
                else if($check == 5){
                    $realAnswers[$i] = rand(9, 10);
                }
            }

            // response
            $newResponse = new Response();
            $newResponse->user_id = 4;
            $newResponse->city_id = $cities[$x]->id;
            $newResponse->questionnaire_id = 2;
            $newResponse->corruption_index = 0;
            $newResponse->save();
            // save response

            $dimensions = Dimension::all();
            $dimensionsCount = $dimensions->count();
            $indicators = Indicator::all();
            $indicatorsCount = $indicators->count();
            $items = Question::all();

            $dimensionArray = [];
            $dimensionArrayIndex = [];
            $indicatorArray = [];
            $indicatorArrayIndex = [];

            foreach ($dimensions as $dimension) {
                $dimensionArray[strtoupper($dimension['id'])] = 0;
                $dimensionArrayIndex[strtoupper($dimension['id'])] = 0;
            }


            foreach ($indicators as $indicator) {
                $indicatorArray[strtoupper($indicator['id'])] = 0;
                $indicatorArrayIndex[strtoupper($indicator['id'])] = 0;
            }

            for ($i = 0; $i < $questionCount; $i++) {
                $indicatorArrayIndex[strtoupper($items[$i]->indicator_id)] += 1;
                $indicatorArray[strtoupper($items[$i]->indicator_id)] += $realAnswers[$i];

                // new answer
                // $newAnswer = new Answer();
                // $newAnswer->response_id = $newResponse->id;
                // $newAnswer->question_id = $i + 1;
                // $newAnswer->answer_key = $realAnswers[$i];
                // $newAnswer->save();
                //end new answer
            }

            for ($i = 0; $i < $indicatorsCount; $i++) {
                $indicatorArray[strtoupper($indicators[$i]->id)] =
                    $indicatorArray[strtoupper($indicators[$i]->id)] / $indicatorArrayIndex[strtoupper($indicators[$i]->id)];
            }

            foreach ($indicators as $indicator) {
                $dimensionArray[strtoupper($indicator->dimension_id)] += $indicatorArray[strtoupper($indicator->id)];
                $dimensionArrayIndex[strtoupper($indicator->dimension_id)] += 1;

                //new indicator
                $newIndicatorResult = new IndicatorResult();
                $newIndicatorResult->response_id = $newResponse->id;
                $newIndicatorResult->indicator_id = $indicator->id;
                $newIndicatorResult->corruption_index = $indicatorArray[strtoupper($indicator->id)];
                $newIndicatorResult->save();
                //end new indicator
            }

            foreach ($dimensions as $dimension) {
                $dimensionArray[strtoupper($dimension->id)] = $dimensionArray[strtoupper($dimension->id)] / $dimensionArrayIndex[strtoupper($dimension->id)];

                // new dimension
                $newDimensionResult = new DimensionResult();
                $newDimensionResult->response_id = $newResponse->id;
                $newDimensionResult->dimension_id = $dimension->id;

                $newDimensionResult->corruption_index = $dimensionArray[strtoupper($dimension->id)];
                $newDimensionResult->save();
                //end new dimension

            }
            $data = [];
            $i = 0;

            foreach ($dimensionArray as $dimensionResult) {
                $questionKey = 'pertanyaan' . ($i + 1);
                $data[$questionKey] = $dimensionResult;
                $i++;
            }

            $dimensionArrayTotal =  0;

            foreach ($dimensionArray as $dimension) {
                $dimensionArrayTotal = $dimensionArrayTotal + $dimension;
            }
            $dimensionArrayTotal = round((($dimensionArrayTotal / ($dimensionsCount * 10)) * 100), 2);

            // update
            $newResponse->corruption_index = $dimensionArrayTotal;
            $newResponse->save();
            // end update
        }



        dd("success");
    }


    public function randomDataNoAnswers()
    {
        $cities = City::all();
        // dd($cities[$endNumber]);



        for ($x = 0; $x < $cities->count(); $x++) {
            $question = Question::all();
            $questionCount = $question->count();
            $realAnswers = [];
            for ($i = 0; $i < $question->count(); $i++) {
                $realAnswers[$i] = rand(0, 10);
            }

            // response
            $newResponse = new Response();
            $newResponse->user_id = 4;
            $newResponse->city_id = $cities[$x]->id;
            $newResponse->questionnaire_id = 2;
            $newResponse->corruption_index = 0;
            $newResponse->save();
            // save response

            $dimensions = Dimension::all();
            $dimensionsCount = $dimensions->count();
            $indicators = Indicator::all();
            $indicatorsCount = $indicators->count();
            $items = Question::all();

            $dimensionArray = [];
            $dimensionArrayIndex = [];
            $indicatorArray = [];
            $indicatorArrayIndex = [];

            foreach ($dimensions as $dimension) {
                $dimensionArray[strtoupper($dimension['id'])] = 0;
                $dimensionArrayIndex[strtoupper($dimension['id'])] = 0;
            }


            foreach ($indicators as $indicator) {
                $indicatorArray[strtoupper($indicator['id'])] = 0;
                $indicatorArrayIndex[strtoupper($indicator['id'])] = 0;
            }

            for ($i = 0; $i < $questionCount; $i++) {
                $indicatorArrayIndex[strtoupper($items[$i]->indicator_id)] += 1;
                $indicatorArray[strtoupper($items[$i]->indicator_id)] += $realAnswers[$i];

                // new answer
                // $newAnswer = new Answer();
                // $newAnswer->response_id = $newResponse->id;
                // $newAnswer->question_id = $i + 1;
                // $newAnswer->answer_key = $realAnswers[$i];
                // $newAnswer->save();
                //end new answer
            }

            for ($i = 0; $i < $indicatorsCount; $i++) {
                $indicatorArray[strtoupper($indicators[$i]->id)] =
                    $indicatorArray[strtoupper($indicators[$i]->id)] / $indicatorArrayIndex[strtoupper($indicators[$i]->id)];
            }

            foreach ($indicators as $indicator) {
                $dimensionArray[strtoupper($indicator->dimension_id)] += $indicatorArray[strtoupper($indicator->id)];
                $dimensionArrayIndex[strtoupper($indicator->dimension_id)] += 1;

                //new indicator
                $newIndicatorResult = new IndicatorResult();
                $newIndicatorResult->response_id = $newResponse->id;
                $newIndicatorResult->indicator_id = $indicator->id;
                $newIndicatorResult->corruption_index = $indicatorArray[strtoupper($indicator->id)];
                $newIndicatorResult->save();
                //end new indicator
            }

            foreach ($dimensions as $dimension) {
                $dimensionArray[strtoupper($dimension->id)] = $dimensionArray[strtoupper($dimension->id)] / $dimensionArrayIndex[strtoupper($dimension->id)];

                // new dimension
                $newDimensionResult = new DimensionResult();
                $newDimensionResult->response_id = $newResponse->id;
                $newDimensionResult->dimension_id = $dimension->id;

                $newDimensionResult->corruption_index = $dimensionArray[strtoupper($dimension->id)];
                $newDimensionResult->save();
                //end new dimension

            }
            $data = [];
            $i = 0;

            foreach ($dimensionArray as $dimensionResult) {
                $questionKey = 'pertanyaan' . ($i + 1);
                $data[$questionKey] = $dimensionResult;
                $i++;
            }

            $dimensionArrayTotal =  0;

            foreach ($dimensionArray as $dimension) {
                $dimensionArrayTotal = $dimensionArrayTotal + $dimension;
            }
            $dimensionArrayTotal = round((($dimensionArrayTotal / ($dimensionsCount * 10)) * 100), 2);

            // update
            $newResponse->corruption_index = $dimensionArrayTotal;
            $newResponse->save();
            // end update
        }



        dd("success");
    }
}
