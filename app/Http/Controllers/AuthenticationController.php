<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Questionnaire;
use App\Models\Dimension;
use App\Models\Viewpoint;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Auth\Events\Verified;

class AuthenticationController extends Controller
{

    public function userHomeView(){
        return view("user.home");
    }

    public function adminHomeView(){
        $questionnaire = Questionnaire::latest()->first();
        $dimensionGroup = $questionnaire->dimensions()->withAvg("dimensionResults as cpi_score", "corruption_index")->limit(6)->get()->pluck("cpi_score", "name");
        $cpi_score = round($questionnaire->responses()->avg('corruption_index'), 1);
        $responses = $questionnaire
        ->responses()->join("cities", "responses.city_id", "=", "cities.id")
        ->join("provinces", "provinces.id", "=", "cities.province_id")
        ->selectRaw("provinces.name as province_name, count(user_id) as participant_count")
        ->groupBy('province_id','province_name')->orderBy("participant_count", "desc")->limit(5)->get()->pluck("participant_count", "province_name");

        $data = [
            "questionnaire" => $questionnaire,
            "dimensionGroup" => $dimensionGroup,
            "cpi_score" => $cpi_score,
            "responses" => $responses
        ];

        return view("admin.dashboard", $data);
    }
    //
    public function index(){

        if(Auth::check()){
            if(Auth::user()->email_verified_at == NULL){
                Auth::logout();
                return view("guest.login");
            }
            else if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2){
                return redirect('/admin');
            }
            else if(Auth::user()->role_id == 3){
                return redirect('/participant');
            }
        }
        return view("user.home");
    }

    public function login(Request $request){

        $validation = [
            'email' => ['required'],
            'password' => ['required'],
        ];

        $validator = Validator::make($request->all(), $validation);

        if($validator->fails()){
            $request->flashExcept('password');
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $credentials = ["email" => $request->email, "password" => $request->password, "is_accepted" => true];

        if(!Auth::attempt($credentials)){
            return redirect()->back()->withInput()->withErrors(["errors" => "Unauthorized credential."]);
        }

        if(Auth::user()->email_verified_at == null){
            return redirect('/verify/notice');
        }

        return redirect('/');
    }

    public function loginApp(Request $request)
    {
        $validation = [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ];

        $validator = Validator::make($request->all(), $validation);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 422);
        }

        $credentials = ["email" => $request->email, "password" => $request->password, "is_accepted" => true];

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized credentials.',
            ], 401);
        }

        if (Auth::user()->email_verified_at == null) {
            return response()->json([
                'success' => false,
                'message' => 'Email not verified.',
                'redirect' => '/verify/notice',
            ], 403);
        }

        $user = Auth::user();
        $token = $user->createToken('API Token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login successful.',
            'data' => [
                'user' => $user,
                'token' => $token,
            ],
        ], 200);
    }

    public function register(Request $request){
        $validation = [
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:App\Models\User,email'],
            'password' => ['required', Password::min(8)->numbers()->letters(),'confirmed'],
            'password_confirmation' => ['required'],
            'gender' => ['required'],
            'age' => ['required'],
            'education' => ['required'],
            'occupation' => ['required'],
        ];

        $validator = Validator::make($request->all(), $validation);

        if($validator->fails()){
            $request->flashExcept('password');
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $user = new User;
        $user->name = $request->name;
        // $user->username = $request->name;
        $user->email = $request->email;
        $user->role_id = 3;
        $user->password = bcrypt($request->password);
        
        $user->gender = $request->gender;
        $user->age_id = $request->age;
        $user->education_id = $request->education;
        $user->occupation_id = $request->occupation;

        $user->created_at = Carbon::now()->toDateTimeString();
        $user->updated_at = Carbon::now()->toDateTimeString();
        $user->save();

        for($i = 1; $i < 9; $i++){
            $viewpoint = new Viewpoint();
            $viewpoint->user_id = $user->id;
            $viewpoint->viewpoint_type_id = $i;

            if($i == 1){
                $viewpoint->is_effective = $request->viewpoint_1;
            }
            else if($i == 2){
                $viewpoint->is_effective = $request->viewpoint_2;
            }
            else if($i == 3){
                $viewpoint->is_effective = $request->viewpoint_3;
            }
            else if($i == 4){
                $viewpoint->is_effective = $request->viewpoint_4;
            }
            else if($i == 5){
                $viewpoint->is_effective = $request->viewpoint_5;
            }
            else if($i == 6){
                $viewpoint->is_effective = $request->viewpoint_6;
            }
            else if($i == 7){
                $viewpoint->is_effective = $request->viewpoint_7;
            }
            else if($i == 8){
                $viewpoint->is_effective = $request->viewpoint_8;
            }

            $viewpoint->save();
        }

        $user->sendEmailVerificationNotification();

        return redirect()->back()
            ->with('success', 'Succesfully Registered. Verification link sent!');
    }

    public function registerApp(Request $request)
    {
        $validation = [
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:App\Models\User,email'],
            'password' => ['required', Password::min(8)->numbers()->letters(), 'confirmed'],
            'password_confirmation' => ['required'],
            'gender' => ['required'],
            'age' => ['required'],
            'education' => ['required'],
            'occupation' => ['required'],
        ];

        $validator = Validator::make($request->all(), $validation);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = 3;
        $user->password = bcrypt($request->password);
        $user->gender = $request->gender;
        $user->age_id = $request->age;
        $user->education_id = $request->education;
        $user->occupation_id = $request->occupation;
        $user->created_at = Carbon::now()->toDateTimeString();
        $user->updated_at = Carbon::now()->toDateTimeString();
        $user->save();

        $user->sendEmailVerificationNotification();

        return response()->json([
            'success' => true,
            'message' => 'Successfully registered. Verification link sent!',
            'data' => [
                'user' => $user,
            ],
        ], 201);
    }

    public function notice(){
        return view("guest.email-verification");
    }

    public function request()
    {

        if (auth()->user()->hasVerifiedEmail()) {

            return redirect()->back()
            ->withErrors(["errors" => "This account is already verified."]);
        }

        auth()->user()->sendEmailVerificationNotification();

        return redirect()->back()
            ->with('success', 'Verification link sent!');
    }

    public function verify($id, $hash)
    {

        $user = User::findOrFail($id);
        if ($user->hasVerifiedEmail()) {
            return redirect('/login')->withErrors(["errors" => "This account is already verified."]);
        }

        if (hash_equals(sha1($user->getEmailForVerification()), $hash)) {
            $user->markEmailAsVerified();
            event(new Verified($user));

            if(auth()->check()){
                if($user->role_id == 3){
                    return redirect('/participant')->with('success', 'Succesfully Verified!');
                }
                else{
                    return redirect('/admin')->with('success', 'Succesfully Verified!');
                }
            }
            else{
                return redirect('/login')->with('success', 'Succesfully Verified!');
            }
        }

        return redirect('/login')->withErrors(["errors" => "Verification failed!"]);

    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }

    public function logoutApp(){
        Auth::logout();
        return response()->json(['message' => 'Successfully logged out'], 200);
    }


}
