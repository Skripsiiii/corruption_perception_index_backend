<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Province;
use App\Models\Domicile;
use App\Models\Age;
use App\Models\City;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    //
    public function index(){
        $users = User::where("role_id", "=", 3)->paginate(5);
        $ageCounts = Age::withCount('users')->get()->pluck('participants_count', 'name');

        $provinceCounts = User::join('domiciles', 'domiciles.user_id', '=', 'users.id')
            ->join('cities', 'domiciles.city_id', "=", 'cities.id')
            ->join('provinces', 'cities.province_id', "=", 'provinces.id')
            ->whereNull('domiciles.end_date')->groupBy('provinces.id','provinces.name')
            ->selectRaw('provinces.id, provinces.name, count(users.id) as count')->pluck('count', 'name');

        $genderCounts = User::all()->countBy('gender')->toArray();

        $data = [
            "users" => $users,
            "ageCounts" => $ageCounts,
            "provinceCounts" => $provinceCounts,
            "genderCounts" => $genderCounts,
        ];
        return view('admin.participants.participants', $data);
    }

    public function getDomicileByYear($year){

        $domicile = Domicile::select("cities.name as city_name", "cities.id as city_id")->join('cities', 'cities.id', "=", 'domiciles.city_id')
        ->where("user_id", "=", Auth()->user()->id)
        ->whereYear("start_date", "=", intval($year))
        ->orWhereYear("end_date", "=", intval($year))
        ->get();

        return response()->json(["domicile" => $domicile]);
        // dd($user);
    }

    public function show($participant){
        $participant = User::find($participant);
        $domiciles = $participant->domiciles;

        $data = [
            "participant" => $participant,
            "domiciles" => $domiciles
        ];

        return view('admin.participants.participant-detail', $data);
    }

    public function destroy($participant){
        User::destroy($participant);
        return redirect()->back()->with("success", "Successfully Delete Participant");
    }

    public function searchParticipants(Request $request){
        $query = $request->input("query");

        $users = User::join('ages', 'ages.id', "=", 'users.age_id')
        ->where('role_id', 3)
        ->where('users.name', 'LIKE', '%'.$query.'%');

        $users = $users->select('users.*', 'ages.name as age_name')
        ->paginate(5);

        return response()->json(["users" => $users]);
    }

    public function editPofileView(){
        return view('user.setting.edit-profile');
    }

    public function accountSettingView(){
        return view('user.setting.account-setting');
    }

    public function domicilieView(){
        return view('user.setting.domicilie');
    }

    public function viewPointView(){
        return view('user.setting.viewPoint');
    }

    public function changePassword(Request $request){
        if(!Hash::check($request->current_password,Auth()->user()->password)){
            dd("tidak sama");
            return redirect()->back()->withInput()->with('error', 'Password saat ini tidak cocok.');
        }

        $validation = [
            'current_password' => ['required'],
            'password' => ['required', Password::min(8)->numbers()->letters(),'confirmed'],
            'password_confirmation' => ['required'],
        ];

        $validator = Validator::make($request->all(), $validation);

        if($validator->fails()){
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $user = User::findOrFail(Auth::user()->id);
        $user->password = bcrypt($request->password_confirmation);
        $user->updated_at = Carbon::now()->toDateTimeString();
        $user->save();

        return redirect()->back()->with("success", "Successfully Change Password");
    }

    public function updateProfile(Request $request){
        $user = User::find(Auth()->user()->id);
        $user->name = $request->name;
        $user->gender = $request->gender;
        $user->age_id = $request->age;
        $user->education_id = $request->education;
        $user->occupation_id = $request->occupation;
        $user->save();

        return redirect()->back()->with("success", "Successfully Update Profile");
    }

    public function myProfile(Request $request)
    {
        $user = User::find(Auth()->user()->id);

        if (!$user) {
            return response()->json([
                'message' => 'User not found'
            ], Response::HTTP_NOT_FOUND);
        }
        
        return response()->json([
            'user' => $user,
        ], Response::HTTP_OK);
    }

    public function myDomicile(Request $request)
    {
        $user = User::find(Auth()->user()->id);

        if (!$user) {
            return response()->json([
                'message' => 'User not found'
            ], Response::HTTP_NOT_FOUND);
        }
        
        $domicile = Domicile::where('user_id', Auth()->user()->id)->orderBy('created_at', 'asc')->get();

        return response()->json([
            'user' => $domicile,
        ], Response::HTTP_OK);
    }

    public function updateProfileApp(Request $request){
        $user = User::find(Auth()->user()->id);
        $user->name = $request->name;
        $user->gender = $request->gender;
        $user->age_id = $request->age;
        $user->education_id = $request->education;
        $user->occupation_id = $request->occupation;
        $user->save();

        return response()->json(['success' => 'Successfully updated profile.'], 200);
    }

    public function changePasswordApp(Request $request){
        if(!Hash::check($request->current_password, Auth()->user()->password)){
            dd("tidak sama");
            return redirect()->back()->withInput()->with('error', 'Password saat ini tidak cocok.');
        }

        $validation = [
            'current_password' => ['required'],
            'password' => ['required', Password::min(8)->numbers()->letters(),'confirmed'],
            'password_confirmation' => ['required'],
        ];

        $validator = Validator::make($request->all(), $validation);

        if($validator->fails()){
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $user = User::findOrFail(Auth::user()->id);
        $user->password = bcrypt($request->password_confirmation);
        $user->updated_at = Carbon::now()->toDateTimeString();
        $user->save();

        return response()->json(['success' => 'Successfully changed password.'], 200);
    }
}
