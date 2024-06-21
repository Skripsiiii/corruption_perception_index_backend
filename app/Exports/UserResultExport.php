<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Response;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\DimensionResult;
use App\Models\Dimension;

class UserResultExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
    }

    public function view(): View{

        $dimensionResults = DimensionResult::join("responses", "responses.id", "dimension_results.response_id")
        ->select("response_id", "user_id")
        ->groupBy('response_id', 'user_id')->orderBy()->get();

        return view('exports.provinceResponse', ["dimensions" => $dimensions, "dimensionResults" => $dimensionResults]);

        // $dimensions = Dimension::where("questionnaire_id", "=", 2)->get();

        // $dimensionResults = DimensionResult::join('responses', 'responses.id', '=', 'dimension_results.response_id')
        // ->join('users', 'users.id', '=', 'responses.user_id')
        // ->select(
        //     'responses.id as response_id',
        //     'users.id as user_id',
        // )
        // ->groupBy('responses.id', 'users.id')
        // ->get();

        // return view('exports.provinceResponse', ["dimensions" => $dimensions, "dimensionResults" => $dimensionResults]);
    }
}
