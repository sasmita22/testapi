<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\User;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function register(Request $request){
        $name = $request->name;
        $email = $request->email;
        $password = Hash::make($request->password);

        $register = User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password
        ]);

        if ($register){
            return response()->json([
                'success' => true,
                'message' => 'Register success!',
                'data' => $register
            ],201);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Register fail!',
                'data' => ''
            ],400);
        }
    }

    public function login(Request $request){
        $email = $request->email;
        $password = $request->password;

        $user = User::where('email',$email)->first();

        if (Hash::check($password,$user->password)){
            $api_token = base64_encode(Str::random(40));
            $user->update([
                'api_token' => $api_token
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Login success!',
                'data' => [
                    'user' => $user,
                    'api_token' => $api_token
                ]
            ]);
        }
    }
}
