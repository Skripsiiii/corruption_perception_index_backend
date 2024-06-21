<?php

namespace App\Exports;

use App\Models\Response;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ProvinceResponseExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $provincesCorruptions = Response::join("cities", "cities.id", "=", "responses.city_id")
        ->join("provinces", "provinces.id", "=", "cities.province_id")
        ->where("corruption_index", "!=", "null")
        ->select("provinces.id", "provinces.name",  DB::raw('ROUND(AVG(CAST(responses.corruption_index AS DECIMAL(10, 2))), 2) as index_result'))
        ->groupBy("provinces.id", "provinces.name")
        ->orderBy("provinces.id", "ASC")
        ->get();

        // dd($provincesCorruptions);

        return $provincesCorruptions;
    }

    public function query(){
        $provincesCorruptions = Response::join("cities", "cities.id", "=", "responses.city_id")
        ->join("provinces", "provinces.id", "=", "cities.province_id")
        ->where("corruption_index", "!=", "null")
        ->select("provinces.id", "provinces.name",  DB::raw('ROUND(AVG(CAST(responses.corruption_index AS DECIMAL(10, 2))), 2) as index_result'))
        ->groupBy("provinces.id", "provinces.name")->get();

        // dd($provincesCorruptions);

        return $provincesCorruptions;
    }

    public function headings(): array
    {
        return [
            'province_id',
            'province_name',
            'index_result',
        ];
    }
}
