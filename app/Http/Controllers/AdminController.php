<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AdminController extends Controller
{
    public function index(){
        $users = User::where("role_id", 1)->orWhere("role_id", 2)->paginate(10);
        return view("superadmin.admin-management", ["users" => $users]);
    }

    public function store(Request $request){
        $name = $request["name"];
        $email = $request["email"];

        $validation = [
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:App\Models\User,email'],
        ];

        $validator = Validator::make($request->all(), $validation);

        if($validator->fails()){
            session()->flash('error', $validator->errors());
            return response()->json(["success" => $validator->errors()]);
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = 2;
        $user->password = bcrypt($request->name);
        
        $user->gender = "Male";
        $user->age_id = 1;
        $user->education_id = null;
        $user->occupation_id = null;
        $user->email_verified_at = Carbon::now()->toDateTimeString();
        $user->created_at = Carbon::now()->toDateTimeString();
        $user->updated_at = Carbon::now()->toDateTimeString();
        $user->save();

        session()->flash('success', 'Succesfully Created New Admin.');
        return response()->json(["success" => ""]);
    }

    public function accept($admin){
        $admin = User::find($admin);
        $admin->is_accepted = true;
        $admin->accepted_at = Carbon::now()->toDateTimeString();
        $admin->save();
        return redirect()->back()->with("success", "Successfully Accept Admin");
    }

    public function promote($admin){
        $admin = User::find($admin);
        $admin->role_id = 1;
        $admin->save();
        return redirect()->back()->with("success", "Successfully Promote Admin to Superadmin");
    }

    public function destroy($admin){
        User::destroy($admin);
        return redirect()->back()->with("success", "Successfully Delete Admin");
    }

    public function searchAdmins(Request $request){
        $query = $request->input("query");

        $admins = User::where(function($query) {
            $query->where("role_id", 1)
                  ->orWhere("role_id", 2);
        })
        ->where('name', 'LIKE', '%'.$query.'%')
        ->paginate(10);
         
        return response()->json(["admins" => $admins]);
    }

    public function changePassword(Request $request){

        $validation = [
            'current_password' => ['required'],
            'password' => ['required', Password::min(8)->numbers()->letters(),'confirmed'],
            'password_confirmation' => ['required'],
        ];

        $validator = Validator::make($request->all(), $validation);

        if($validator->fails()){
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $credentials = ["username" => Auth::user()->username, "password" => $request->current_password, "is_accepted" => true];
        
        if(!Auth::attempt($credentials)){
            return redirect()->back()->withInput()->withErrors(["errors" => "Unauthorized credential."]);
        }

        $user = User::findOrFail(Auth::user()->id);

        $user->password = bcrypt($request->password_confirmation);
        $user->updated_at = Carbon::now()->toDateTimeString();
        $user->save();

        return redirect()->back()->with("success", "Successfully Change Password");
    }
}
