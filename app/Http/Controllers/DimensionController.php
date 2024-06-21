<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dimension;
use App\Models\Questionnaire;
use App\Models\City;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Response;

class DimensionController extends Controller
{

    private function createDataAndModel()
    {
        $count = Dimension::all()->count();
        $data = Http::post('http://localhost:5000/api/Generate_data', [
            'Dimension' => $count
        ]);
        $model = Http::post('http://localhost:5000/api/Generate_Model');
    }

    //
    public function store($questionnaire, Request $request)
    {
        $validation = [
            'dimension_name' => ['required'],
        ];

        $validator = Validator::make($request->all(), $validation);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $max_dimension_number = Dimension::selectRaw('MAX(CAST(SUBSTRING_INDEX(dimension_number, "_", -1) AS UNSIGNED)) AS max_dimension_number')->where("questionnaire_id", Questionnaire::where("year", "=", $questionnaire)->first()->id)->first()->max_dimension_number;

        $dimension = new Dimension;
        $dimension->dimension_number = 'DIM_' . ($max_dimension_number ? $max_dimension_number + 1 : 1);
        $dimension->name = $request->dimension_name;
        $questionnaire = Questionnaire::where("year", "=", $questionnaire)->first();
        $dimension->questionnaire_id = $questionnaire->id;
        $dimension->save();

        $this->createDataAndModel();
        return redirect()->back()->with("success", "Successfully created new dimension");
    }

    public function update($id, Request $request)
    {
        $validation = [
            'newDimensionName' => ['required'],
        ];

        $validator = Validator::make($request->all(), $validation);

        if ($validator->fails()) {
            return response()->json(["error" => $validator->errors()]);
        }

        $dimension = Dimension::find($id);
        $dimension->name = $request->input("newDimensionName");
        $dimension->save();

        session()->flash('success', "Successfully Update Dimension Name");
        return response()->json(["success" => "success"]);
    }

    public function dimensionCorruptionData($city_id)
    {
        $city = City::find($city_id);

        $dimensionCorruptionResults = DB::table('responses')
            ->join('cities as ct', 'responses.city_id', '=', 'ct.id')
            ->join('provinces as pv', 'pv.id', '=', 'ct.province_id')
            ->join('dimension_results as dr', 'dr.response_id', '=', 'responses.id')
            ->join('dimensions as ds', 'ds.id', '=', 'dr.dimension_id')
            ->where('ct.id', 1)
            ->select('ds.id', 'ds.name', DB::raw('CAST(AVG(dr.corruption_index) AS signed) as index_result'))
            ->groupBy('ds.id', 'ds.name')
            ->orderBy("index_result", "asc")
            ->paginate(10);

        return view("admin.participants.participant-corruption-dimension", ["dimensionCorruptionResults" => $dimensionCorruptionResults, "city" => $city]);
    }

    public function dimensionCorruptionDataApp($city_id)
    {
        $city = City::find($city_id);

        if (!$city) {
            return response()->json([
                'message' => 'City not found'
            ], Response::HTTP_NOT_FOUND);
        }

        $dimensionCorruptionResults = DB::table('responses')
            ->join('cities as ct', 'responses.city_id', '=', 'ct.id')
            ->join('provinces as pv', 'pv.id', '=', 'ct.province_id')
            ->join('dimension_results as dr', 'dr.response_id', '=', 'responses.id')
            ->join('dimensions as ds', 'ds.id', '=', 'dr.dimension_id')
            ->where('ct.id', $city_id)
            ->select('ds.id', 'ds.name', DB::raw('CAST(AVG(dr.corruption_index) AS signed) as index_result'))
            ->groupBy('ds.id', 'ds.name')
            ->orderBy('index_result', 'asc')
            ->paginate(17);

        return response()->json([
            'city' => $city,
            'dimensionCorruptionResults' => $dimensionCorruptionResults,
        ], Response::HTTP_OK);
    }


    public function destroy($dimension)
    {
        Dimension::destroy($dimension);
        createDataAndModel();
        return redirect()->back()->with("success", "Successfully delete dimension");
    }
}
