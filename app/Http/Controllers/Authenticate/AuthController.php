<?php

namespace App\Http\Controllers\Authenticate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //

    public function signin(Request $request){

        try{
            $data = $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);

            $user = User::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                return response([
                    'message' => ['These credentials do not match our records.']
                ], 404);
            }

            $token = $user->createToken('NugaPosV1@2021')->plainTextToken;

            $response = [
                'user' => $user,
                'token' => $token
            ];

            return response($response, 201);

        }catch(Exception $ex){
            return response($ex);

        }

    }


    public function register(Request $request){
        try{
            $data = $request->validate([
                'email' => 'required|email',
                'name' => 'required',
                'password' => 'required',
                'status' => 'required',
                'roles_id' => 'required'
            ]);

            $user = config('roles.models.defaultUser')::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
            ]);
            if($request->roles_id == 1){
                $role = config('roles.models.role')::where('name', '=', 'User')->first();  //choose the default role upon user creation.
            }
            if($request->roles_id == 2){
                $role = config('roles.models.role')::where('name', '=', 'Admin')->first();  //choose the default role upon user creation.
            }
            $user->attachRole($role);



            $response = [
                'user' => $user,
            ];

            return response($response, 201);

        }catch(Exception $ex){
            return response($ex);

        }


    }
}
