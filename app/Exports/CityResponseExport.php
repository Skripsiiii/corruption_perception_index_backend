<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Response;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CityResponseExport implements FromCollection, WithHeadings
{

    protected $province_id;

    public function __construct($province_id)
    {
        $this->province_id = $province_id;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
        $cityCorruptionResults = Response::join('cities as ct', 'responses.city_id', '=', 'ct.id')
        ->join('provinces as pv', 'pv.id', '=', 'ct.province_id')
        ->join('dimension_results as dr', 'dr.response_id', '=', 'responses.id')
        ->select('ct.id', 'ct.name', DB::raw('avg(dr.corruption_index)* 10 as index_result'))
        ->where('pv.id', $this->province_id)
        ->where("responses.corruption_index", "!=", "null")
        ->groupBy('ct.name', "ct.id")
        ->get();

        return $cityCorruptionResults;
    }

    public function headings(): array
    {
        return [
            'city_id',
            'city_name',
            'index_result',
        ];
    }
}
