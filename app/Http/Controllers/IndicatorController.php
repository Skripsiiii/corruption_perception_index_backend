<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Indicator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Response;

class IndicatorController extends Controller
{
    //
    public function store(Request $request)
    {
        $dimensionId = $request->input("dimensionId");

        $indicatorName = $request->input("indicatorName");

        $validation = [
            'indicatorName' => ['required'],
        ];

        $validator = Validator::make($request->all(), $validation);

        if ($validator->fails()) {
            return response()->json(["error" => $validator->errors()]);
        }

        $max_indicator_number = Indicator::selectRaw('MAX(CAST(SUBSTRING_INDEX(indicator_number, "_", -1) AS UNSIGNED)) AS max_indicator_number')->where("dimension_id", $dimensionId)->first()->max_indicator_number;

        $newIndicator = new Indicator;
        $newIndicator->indicator_number = 'IND_' . ($max_indicator_number ? $max_indicator_number + 1 : 1);
        $newIndicator->dimension_id = $dimensionId;
        $newIndicator->name = $indicatorName;
        $newIndicator->save();

        session()->flash('success', "Successfully create new indicator");
        return response()->json(["success" => "Successfully create new indicator"]);
    }

    public function update($id, Request $request)
    {
        $validation = [
            'indicatorName' => ['required'],
        ];

        $validator = Validator::make($request->all(), $validation);

        if ($validator->fails()) {
            return response()->json(["error" => $validator->errors()]);
        }

        $indicatorName = $request->input("indicatorName");
        $indicator = Indicator::find($id);
        $indicator->name = $indicatorName;
        $indicator->save();

        session()->flash('success', "Successfully update indicator");
        return response()->json(["success" => "Successfully update indicator"]);
    }

    public function destroy($indicator)
    {
        Indicator::destroy($indicator);
        return redirect()->back()->with("success", "Successfully delete indicator");
    }

    public function getIndicators(Request $request)
    {
        $indicators = Indicator::where("dimension_id", "=", $request->input("dimensionId"))->get();
        return response()->json(["indicators" => $indicators]);
    }

    public function indicatorCorruptionData($dimension_id)
    {
        $indicatorCorruptionResults = DB::table('responses')
            ->join('cities as ct', 'responses.city_id', '=', 'ct.id')
            ->join('provinces as pv', 'pv.id', '=', 'ct.province_id')
            ->join('dimension_results as dr', 'dr.response_id', '=', 'responses.id')
            ->join('dimensions as ds', 'ds.id', '=', 'dr.dimension_id')
            ->join('indicators as ic', 'ic.dimension_id', '=', 'ds.id')
            ->join('indicator_results as ir', 'ir.response_id', '=', 'responses.id')
            ->select('ic.name', 'ic.id', DB::raw('cast(avg(ir.corruption_index) as signed) as index_result'))
            ->where('ds.id', $dimension_id)
            ->groupBy('ic.name', 'ic.id')
            ->paginate(10);


            return view('admin.participants.participant-corruption-indicator',compact("indicatorCorruptionResults"));
    }

    public function indicatorCorruptionDataApp($dimension_id)
    {
        $indicatorCorruptionResults = DB::table('responses')
            ->join('cities as ct', 'responses.city_id', '=', 'ct.id')
            ->join('provinces as pv', 'pv.id', '=', 'ct.province_id')
            ->join('dimension_results as dr', 'dr.response_id', '=', 'responses.id')
            ->join('dimensions as ds', 'ds.id', '=', 'dr.dimension_id')
            ->join('indicators as ic', 'ic.dimension_id', '=', 'ds.id')
            ->join('indicator_results as ir', 'ir.response_id', '=', 'responses.id')
            ->select('ic.name', 'ic.id', DB::raw('cast(avg(ir.corruption_index) as signed) as index_result'))
            ->where('ds.id', $dimension_id)
            ->groupBy('ic.name', 'ic.id')
            ->paginate(10);

        return response()->json([
            'indicatorCorruptionResults' => $indicatorCorruptionResults,
        ], Response::HTTP_OK);
    }

}
