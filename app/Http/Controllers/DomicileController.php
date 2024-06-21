<?php

namespace App\Http\Controllers;

use App\Models\Domicile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class DomicileController extends Controller
{
    
    public function store(Request $request){
        $validation = [
            'provinceId' => ['required', 'exists:provinces,id'],
            'cityId' => ['required', 'exists:cities,id'],
            'domicileStartDate' => ['required'],
        ];


        $validator = Validator::make($request->all(), $validation);

        if($validator->fails()){
            return response()->json(["error" => $validator->errors()]);
        }

        $userId = $request->input("userId");
        $cityId = $request->input("cityId");
        $domicileStartDate = $request->input("domicileStartDate");

        $domiciles = Domicile::where('user_id', auth()->user()->id)
        ->whereNull('end_date')->update(['end_date' => $domicileStartDate]);

        $newDomicile = new Domicile();
        $newDomicile->user_id = Auth()->user()->id;
        $newDomicile->city_id = $cityId;
        $newDomicile->start_date = $domicileStartDate;
        $newDomicile->save();

        // $domicile = new Domicile();


        // foreach ($domiciles as $domicile) {
        //     $domicile->end_date = Date::now();
        //     $domicile->save();
        // }

        session()->flash('success', "Successfully Insert Domicilie");
        return response()->json(["success" => $cityId]);
    }

    public function newDomicile(Request $request)
    {
        $validation = [
            'cityId' => ['required', 'exists:cities,id'],
        ];

        $validator = Validator::make($request->all(), $validation);

        if($validator->fails()){
            return response()->json(["error" => $validator->errors()]);
        }

        $userId = $request->input("userId");
        $cityId = $request->input("cityId");

        $domicileStartDate = now();

        Domicile::where('user_id', Auth()->user()->id)
            ->whereNull('end_date')
            ->update(['end_date' => $domicileStartDate]);

        // Create new domicile
        $newDomicile = new Domicile();
        $newDomicile->user_id = Auth()->user()->id;
        $newDomicile->city_id = $cityId;
        $newDomicile->start_date = $domicileStartDate;
        $newDomicile->save();

        return response()->json(["success" => $cityId]);
    }
    
    
    
}
