<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function users(Request $request){
        $name = $request->name;
        $users = User::get();
        return response()->json(['users'=>$users], 200);
    }

    public function userStore(Request $request){
        $validate = $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email',
                'date_of_birth' => 'required|date'
            ],
            [
                'name.required' => 'Please provide an Name',
                'email.required' => 'Please provide an E-mail',
                'email.email' => 'Please provide a valid Email',
                'date_of_birth.required' => 'Please provide a Date of birth'
            ]
        );

        $hasUser = User::where(['email'=>$request->email])->first();
        if($hasUser) return response()->json(['message'=> 'This email already used'], 409);

        $store_data = new User();
        $store_data->name = $request->name;
        $store_data->email = $request->email;
        $store_data->date_of_birth = $request->date_of_birth;
        $saved = $store_data->save();
        if($saved) {
            return response()->json(['message'=> 'User data stored Successfully'], 201);
        } else {
            return response()->json(['message'=> 'Something went Wrong'], 500);
        }

    }

    public function userUpdate(Request $request){
        $update_data = User::find($request->id);
        
        if(!$update_data) return response()->json(['message'=> 'User not found'], 404);

        $update_data->name = $request->name ?? $update_data->name;
        $update_data->email = $request->email ?? $update_data->email;
        $update_data->date_of_birth = $request->date_of_birth ?? $update_data->date_of_birth;
        $saved = $update_data->save();
        if($saved) {
            return response()->json(['message'=> 'User data updated Successfully'], 200);
        } else {
            return response()->json(['message'=> 'Something went Wrong'], 500);
        }
    }

    public function userDelete(Request $request){
        $delete_data = User::find($request->id);
        
        if(!$delete_data) return response()->json(['message'=> 'User not found'], 404);
        $deleted = $delete_data->delete();

        if($deleted) {
            return response()->json(['message'=> 'User data deleted Successfully'], 200);
        } else {
            return response()->json(['message'=> 'Something went Wrong'], 500);
        }

    }
}
