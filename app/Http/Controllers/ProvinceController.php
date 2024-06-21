<?php

namespace App\Http\Controllers;

use App\Models\Province;
use App\Models\Dimension;
use App\Models\DimensionResult;
use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Exports\ProvinceResponseExport;
use App\Exports\UserResultExport;
use Maatwebsite\Excel\Facades\Excel;

class ProvinceController extends Controller
{
    
    public function getProvinces(Request $request)
    {
        $provinces = Province::join("cities", "cities.id", "provinces.id")
            ->join("responses", "responses.city_id", "cities.id")
            ->whereNotNull("provinces.longitude")
            ->groupBy("provinces.id")
            ->select("provinces.name", "provinces.id as provinceId", "provinces.latitude", "provinces.longitude")
            ->selectRaw("CAST(AVG(responses.corruption_index) as DECIMAL(10,0)) as cpi_score")
            ->get();

        return response()->json(["provinces" => $provinces]);
    }

    public function getProvincesApp(Request $request)
    {
        $provinces = Province::select('id', 'name', 'latitude', 'longitude')->get();

        return response()->json(["provinces" => $provinces]);
    }

    public function getCitiesResult(Request $request)
    {
        $cities = City::join("responses", "responses.city_id", "cities.id")
            ->whereNotNull("cities.longitude")
            ->groupBy("cities.id")
            ->select("cities.name", "cities.id as cityId", "cities.latitude", "cities.longitude")
            ->selectRaw("CAST(AVG(responses.corruption_index) as DECIMAL(10,0)) as cpi_score")
            ->get();

        return response()->json(["cities" => $cities]);
    }

    public function provinceDataCorruption()
    {
        $provinces = Province::all();
        $provincesCorruption = Response::join("cities", "cities.id", "=", "responses.city_id")
            ->join("provinces", "provinces.id", "=", "cities.province_id")
            ->select("provinces.id", "provinces.name", DB::raw('avg(responses.corruption_index) as index_result'))
            ->groupBy("provinces.name", "provinces.id")->paginate(10);
        return view("admin.participants.participant-corruption", compact("provincesCorruption"));
    }

    public function provinceDataCorruptionApp()
    {
        $provincesCorruption = Response::join("cities", "cities.id", "=", "responses.city_id")
            ->join("provinces", "provinces.id", "=", "cities.province_id")
            ->select("provinces.id", "provinces.name", DB::raw('avg(responses.corruption_index) as index_result'))
            ->groupBy("provinces.name", "provinces.id")->paginate(38);

        return response()->json([
            'success' => true,
            'data' => $provincesCorruption
        ]);
    }

    public function mapView()
    {
        $province = Province::all();
        $provincesCorruption = Response::join("cities", "cities.id", "=", "responses.city_id")
            ->join("provinces", "provinces.id", "=", "cities.province_id")
            ->where("corruption_index", "!=", "null")
            ->select("provinces.id", "provinces.name", "provinces.longitude", "provinces.latitude", DB::raw('ROUND(AVG(CAST(responses.corruption_index AS DECIMAL(10, 2))), 2) as index_result'))
            ->groupBy("provinces.name", "provinces.id", "provinces.longitude", "provinces.latitude")->get();

        $result = Response::join('cities as c', 'responses.city_id', '=', 'c.id')
            ->join('provinces as p', 'p.id', '=', 'c.province_id')
            ->where("corruption_index", "!=", "null")
            ->select('p.name as provinces', 'c.name as city', DB::raw('ROUND(AVG(CAST(responses.corruption_index AS DECIMAL(10, 2))), 2) as index_result'))
            ->groupBy('p.name', 'c.name')
            ->get();

        $lowestProvinces = $result->groupBy('provinces')
            ->map(function ($group) {
                return [
                    $group->min('index_result'),

                ];
            });

        // $filteredResults = collect([]);

        // foreach ($result as $record) {
        //     if ($record->index_result == $minResults[$record->provinces][0] && !$filteredResults->contains('provinces',$record->provinces)) {
        //         $filteredResults->push([$record]);
        //     }
        // }
        $filePath = public_path('js/indonesia-provinces.json');
        $jsonData = json_decode(file_get_contents($filePath), true);
        // dd($jsonData);
        return view("alluser.map", compact("provincesCorruption", "lowestProvinces",'jsonData'));
    }

    public function mapViewApp()
    {
        $provincesCorruption = Response::join("cities", "cities.id", "=", "responses.city_id")
            ->join("provinces", "provinces.id", "=", "cities.province_id")
            ->where("corruption_index", "!=", "null")
            ->select("provinces.id", "provinces.name", "provinces.longitude", "provinces.latitude", DB::raw('ROUND(AVG(CAST(responses.corruption_index AS DECIMAL(10, 2))), 2) as index_result'))
            ->groupBy("provinces.name", "provinces.id", "provinces.longitude", "provinces.latitude")->get();

        $result = Response::join('cities as c', 'responses.city_id', '=', 'c.id')
            ->join('provinces as p', 'p.id', '=', 'c.province_id')
            ->where("corruption_index", "!=", "null")
            ->select('p.name as provinces', 'c.name as city', DB::raw('ROUND(AVG(CAST(responses.corruption_index AS DECIMAL(10, 2))), 2) as index_result'))
            ->groupBy('p.name', 'c.name')
            ->get();

        $lowestProvinces = $result->groupBy('provinces')
            ->map(function ($group) {
                return [
                    $group->min('index_result'),
                ];
            });

        $filePath = public_path('js/indonesia-provinces.json');
        $jsonData = json_decode(file_get_contents($filePath), true);

        return response()->json([
            'success' => true,
            'data' => [
                'provincesCorruption' => $provincesCorruption,
                'lowestProvinces' => $lowestProvinces,
                'jsonData' => $jsonData
            ]
        ]);
    }

        public function export_provinces(){

            // $provincesCorruptions = Response::join("cities", "cities.id", "=", "responses.city_id")
            // ->join("provinces", "provinces.id", "=", "cities.province_id")
            // ->where("corruption_index", "!=", "null")
            // ->select("provinces.id", "provinces.name",  DB::raw('ROUND(AVG(CAST(responses.corruption_index AS DECIMAL(10, 2))), 2) as index_result'))
            // ->groupBy("provinces.id", "provinces.name")->get();

            return Excel::download(new ProvinceResponseExport, 'province_responses.xlsx');

            $dimensions = Dimension::where("questionnaire_id", "=", 2)->get();

            // $dimensionResults = DimensionResult::join('responses', 'responses.id', '=', 'dimension_results.response_id')
            // ->join('users', 'users.id', '=', 'responses.user_id')
            // ->distinct(
                // 'responses.id as response_id',
                // 'users.id as user_id'
            // )
            // ->get();

            // $dimensionResults = DimensionResult::join("responses", "responses.id", "dimension_results.response_id")
            // ->select("response_id", "user_id")
            // ->groupBy('response_id', 'user_id')->get();

            $dimensionResults = DimensionResult::join("responses", "responses.id", "dimension_results.response_id")
            ->select("response_id", "user_id")
            ->groupBy('response_id', 'user_id')->get();

            return view('exports.provinceResponse', ["dimensions" => $dimensions, "dimensionResults" => $dimensionResults]);
            // return Excel::download(new UserResultExport, 'province_responses.xlsx');
        }

        public function test(){
            return Excel::download(new UserResultExport, 'province_responses.xlsx');
            return Excel::download(new ProvinceResponseExport, 'province_responses.xlsx');
        }

    }
