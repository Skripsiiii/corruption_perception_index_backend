<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Questionnaire;

class DimensionResultController extends Controller
{
    //
    public function index(){
        $questionnaire = Questionnaire::latest()->first();
        $raw = $questionnaire->dimensions()->withAvg("dimensionResults as cpi_score", "corruption_index")->orderBy("cpi_score", "asc")->get()->pluck("cpi_score", "name");

        foreach ($raw as $key => $value) {
            $newKey = $key;
            $newKey = str_replace('Dimensi ', '', $newKey);
            $newKey = str_replace('Persepsi Anda tentang ', '', $newKey);
            $newKey = str_replace('Persepsi Anda terhadap ', '', $newKey);
            $newKey = str_replace('Persepsi terhadap ', '', $newKey);
            $newKey = str_replace('Persepsi Anda tentang', '', $newKey);
            $newKey = str_replace('Penilaian Anda tentang', '', $newKey);
            $dimensionGroup[$newKey] = $value;
        }

        $data = [
            "questionnaire" => $questionnaire,
            "dimensionGroup" => $dimensionGroup
        ];

        return view("admin.statistic", $data);
    }
}
