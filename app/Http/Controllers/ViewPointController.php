<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Viewpoint;
use App\Models\ViewpointType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ViewPointController extends Controller
{
    public function viewPointUpdate(Request $request)
    {
        $count = count($request->all());
        for ($i = 1; $i < $count; $i++) {
            // $viewpoint = Viewpoint::select('*')->where('user_id','like', Auth()->user()->id)
            //     ->where('viewpoint_type_id', $i)
            //     ->first();

            Viewpoint::where('user_id', Auth()->user()->id)
                ->where('viewpoint_type_id', $i)
                ->update(['is_effective' => $request->input((string)$i)]);

        }
        return redirect()->back()->with("success", "Successfully Update View Point");
    }

    public function viewPointUpdateApp(Request $request)
    {
        $count = count($request->all());
        for ($i = 1; $i < $count; $i++) {
            // $viewpoint = Viewpoint::select('*')->where('user_id','like', Auth()->user()->id)
            //     ->where('viewpoint_type_id', $i)
            //     ->first();

            Viewpoint::where('user_id', Auth()->user()->id)
                ->where('viewpoint_type_id', $i)
                ->update(['is_effective' => $request->input((string)$i)]);

        }
        return response()->json(['success' => "Successfully Update View Point"]);
    }

    public function storeViewpoints(Request $request)
    {
        $user = User::find(Auth()->user()->id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found.',
            ], 404);
        }

        for ($i = 1; $i <= 8; $i++) {
            $viewpoint = new Viewpoint();
            $viewpoint->user_id = Auth()->user()->id;
            $viewpoint->viewpoint_type_id = $i;
            $viewpoint->is_effective = $request->input("viewpoint_$i", false);
            $viewpoint->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Viewpoints saved successfully.',
        ], 201);
    }

    public function getViewpoints(Request $request)
    {
        $viewpoints = ViewpointType::select('id', 'name')->get();

        // $user = Auth::user();

        return response()->json(["viewpoints" => $viewpoints]);
    }

    public function getViewpointResponses(Request $request)
    {
        $user = Auth::user();

        $userId = $user->id;

        $user = $viewpoints = Viewpoint::where('user_id', $userId)
        ->select('user_id', 'viewpoint_type_id', 'is_effective')
        ->get();

        return response()->json(["viewpoints" => $viewpoints]);
    }
}
