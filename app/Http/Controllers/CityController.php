<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Response;
use App\Models\Province;
use Illuminate\Support\Facades\DB;
use App\Exports\CityResponseExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;


class CityController extends Controller
{
    
    public function cityView($city)
    {
        $province = Province::where("name", $city)->first();
        // $city = City::where("province_id",$province->id)->get();
        $city = DB::table('responses as r')
            ->join('cities as c', 'r.city_id', '=', 'c.id')
            ->join('dimension_results as dr', 'r.id', '=', 'dr.response_id')
            ->join('provinces as p', 'c.province_id', '=', 'p.id')
            ->select('p.name', 'c.name', 'c.latitude', 'c.longitude', DB::raw('avg(r.corruption_index) as index_result'))
            ->where('p.name', 'LIKE', $city)
            ->groupBy('p.name', 'c.name', 'c.latitude', 'c.longitude')
            ->get();
        // dd($city);
        // $citytest = DB::table('cities as c')->join('provinces as p','c.province_id','p.id')
        // ->select('c.name')
        // ->where('p.name',"LIKE","Aceh")
        // ->get();

        // dd($city);


        // dd($city);
        $filePath = public_path('js/all_kabkota_ind.json');
        $jsonData = json_decode(file_get_contents($filePath), true);
        foreach ($jsonData['features'] as $feature) {
            // Periksa apakah properti "prov_name" sama dengan "Daerah Istimewah YOGYAKARTA"
            foreach($city as $c){
                if ($feature['properties']['alt_name'] === strtoupper($c->name)) {
                    $filteredFeatures[] = $feature;
                }
            }

        }
        $filteredGeojson = [
            'type' => 'FeatureCollection',
            'features' => $filteredFeatures,
        ];
        // dd($filteredGeojson);
        return view("alluser.citymap", compact("province", "city", "filteredGeojson"));
    }

    public function cityViewApp($city)
    {
        $province = Province::where("name", $city)->first();
        if (!$province) {
            return response()->json(['success' => false, 'message' => 'Province not found'], 404);
        }

        $cityData = DB::table('responses as r')
            ->join('cities as c', 'r.city_id', '=', 'c.id')
            ->join('dimension_results as dr', 'r.id', '=', 'dr.response_id')
            ->join('provinces as p', 'c.province_id', '=', 'p.id')
            ->select('p.name as province_name', 'c.name as city_name', 'c.latitude', 'c.longitude', DB::raw('avg(r.corruption_index) as index_result'))
            ->where('p.name', 'LIKE', $city)
            ->groupBy('p.name', 'c.name', 'c.latitude', 'c.longitude')
            ->get();

        $filePath = public_path('js/all_kabkota_ind.json');
        $jsonData = json_decode(file_get_contents($filePath), true);
        $filteredFeatures = [];
        foreach ($jsonData['features'] as $feature) {
            foreach ($cityData as $c) {
                if ($feature['properties']['alt_name'] === strtoupper($c->city_name)) {
                    $filteredFeatures[] = $feature;
                }
            }
        }

        $filteredGeojson = [
            'type' => 'FeatureCollection',
            'features' => $filteredFeatures,
        ];

        return response()->json([
            'success' => true,
            'data' => [
                'province' => $province,
                'cityData' => $cityData,
                'filteredGeojson' => $filteredGeojson
            ]
        ]);
    }


    public function getCities(Request $request, $provinceId)
    {
        $cities = City::where("province_id", "=", $request->input("provinceId"))->get();
        return response()->json(["cities" => $cities]);
    }

    public function getCitiesApp(Request $request, $provinceId)
    {
        $cities = City::where('province_id', $provinceId)->get();
        return response()->json(["cities" => $cities]);
    }

    public function cityCorruptionData($province_id)
    {
        $province = Province::find($province_id);
        $provincesCorruption = Response::join("cities", "cities.id", "=", "responses.city_id")
            ->join("provinces", "provinces.id", "=", "cities.province_id")
            ->select("provinces.id", "provinces.name", DB::raw('avg(responses.corruption_index) as index_result'))
            ->groupBy("provinces.name", "provinces.id")
            ->where("provinces.id", $province_id)->first()->index_result;

        $cityCorruptionResults = DB::table('responses')
            ->join('cities as ct', 'responses.city_id', '=', 'ct.id')
            ->join('provinces as pv', 'pv.id', '=', 'ct.province_id')
            ->join('dimension_results as dr', 'dr.response_id', '=', 'responses.id')
            ->select('ct.id', 'ct.name', DB::raw('avg(dr.corruption_index)* 10 as index_result'))
            ->where('pv.id', $province_id)
            ->where("responses.corruption_index", "!=", "null")
            ->groupBy('ct.name', "ct.id")
            ->paginate(10);

        return view("admin.participants.participant-corruption-city", ["cityCorruptionResults" => $cityCorruptionResults, "province" => $province, "provincesCorruption" => $provincesCorruption]);
    }

    public function cityCorruptionDataApp($province_id)
    {
        $province = Province::find($province_id);
        if (!$province) {
            return response()->json(['success' => false, 'message' => 'Province not found'], 404);
        }

        $provincesCorruption = Response::join("cities", "cities.id", "=", "responses.city_id")
            ->join("provinces", "provinces.id", "=", "cities.province_id")
            ->select("provinces.id", "provinces.name", DB::raw('avg(responses.corruption_index) as index_result'))
            ->groupBy("provinces.name", "provinces.id")
            ->where("provinces.id", $province_id)
            ->first();

        if ($provincesCorruption) {
            $provincesCorruption = $provincesCorruption->index_result;
        } else {
            $provincesCorruption = null;
        }

        $cityCorruptionResults = DB::table('responses')
            ->join('cities as ct', 'responses.city_id', '=', 'ct.id')
            ->join('provinces as pv', 'pv.id', '=', 'ct.province_id')
            ->join('dimension_results as dr', 'dr.response_id', '=', 'responses.id')
            ->select('ct.id', 'ct.name', DB::raw('avg(dr.corruption_index)* 10 as index_result'))
            ->where('pv.id', $province_id)
            ->where("responses.corruption_index", "!=", "null")
            ->groupBy('ct.name', "ct.id")
            ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => [
                'province' => $province,
                'provincesCorruption' => $provincesCorruption,
                'cityCorruptionResults' => $cityCorruptionResults
            ]
        ]);
    }


    public function export_cities($province_id){
        $province = Province::find($province_id);
        return Excel::download(new CityResponseExport($province_id), $province->name . '_city_responses.xlsx');
    }
}
