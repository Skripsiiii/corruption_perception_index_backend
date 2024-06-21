<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ViewPointDetail;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ViewPointDetailController extends Controller
{
    public function getViewPointDetail(){
        $user = User::find(auth()->user()->id);
        $vpDetail = ViewPointDetail::where('user_id','=',$user->id)->get();

        return response()->json([
            "data" => $vpDetail
        ],Response::HTTP_OK);
    }
}
