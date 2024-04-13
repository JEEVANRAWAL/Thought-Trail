<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request){
        $validator= Validator::make($request->all(),[
            'name'=> 'required',
            'email'=> 'required|email|unique:users',
            'password'=> 'required|min:6'
        ]);

        if($validator->fails()){
            return response()->json(['errors'=> $validator->errors()], 422);
        }else{
            $userData= $validator->validate();
            $user= User::create([
                "name"=> $userData['name'],
                "email"=>$userData['email'],
                "password"=>$userData['password'],
                "userType"=>"normal"
            ]);

            if(!$user){
                return response(["message"=>"user not registered"]);
            }else{
                return response()->json(['message'=>'user registered successfully'], 200);
            }
        }
       
    }

    public function login(Request $request){
        if(!Auth::attempt($request->only('email', 'password'))){
            return response()->json(['message'=>"Credentials didn't match"], 401);
        }else{
            
            $user= Auth::user();
            if($user instanceof \App\Models\User){
                $token= $user->createToken('token')->plainTextToken;
                $cookie= cookie('jwt', $token, 60*24);
                return response(['message'=>'loged in successfully'], 200)->withCookie($cookie);
            }
        }
    }

    public function user(){
       $user = Auth::user();
        return response(['user'=>$user]);
    }
}
