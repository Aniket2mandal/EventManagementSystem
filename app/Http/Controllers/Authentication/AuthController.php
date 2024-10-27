<?php

namespace App\Http\Controllers\Authentication;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginindex(){
        return view('USER.auth.login');
    }

    public function login(Request $request){

        $validate=$request->validate([
            'email'=>'required|string',
            'password'=>'required',
              ]);

        $user=User::where('email',$request->email)->first();

        if($user && Hash::check($request->password,$user->password)){
             return redirect()->route('home');
            //  if ($request->expectsJson()) {
            //     $token=$user->createToken('Access Token')->accessToken;
            //     return response()->json([
            //         'status' => 200,
            //         'message' => "User logged in successfully",
            //         'access_token' => $token,
            //     ]);
            // }
        }
        else{
            return redirect()->route('user.loginindex')->with('error','Invalid Username/Password');
            // if ($request->expectsJson()) {
                // return response()->json([
                //     'status' => 404,
                //     'message' => "unable to login",

                // ]);
            // }
        }
    }


    public function registerindex(){
        return view('USER.auth.register');
    }

    public function register(Request $request){
        // dd($request);
                $validate=$request->validate([
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:users',
                    'password' => 'required|string|min:8|confirmed',
                      ]);

                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);

                // return response()->json(['message' => 'User successfully registered'], 201);
                return redirect()->route('user.loginindex')->with('success','User created sucessfully');
            }

            public function logout(Request $request){
                $logout=Auth::logout();

                return redirect()->route('user.loginindex')->with('success','User logedout sucessfully');
            }

            // public function Apilogout(Request $request){
            //     $logout=Auth::logout();
            //     if($logout){
            //         $request->user()->currentAccessToken()->delete();
            //         return response()->json([
            //             'status'=>200,
            //            'message'=>"User loged in successfully",
            //             'access_token'=>$token
            //         ]);
            //     }
            // }



            // public function apilogin(Request $request){
            //     $validate=$request->validate([
            //         'email'=>'required|string',
            //         'password'=>'required',
            //           ]);

            //     $user=User::where('email',$request->email)->first();
            //     if(Hash::check($request->password,$user->password)){
            //         $token=$user->createToken('Access Token')->accessToken;
            //     }
            //     else{
            //         return response()->json([
            //             'status'=>401,
            //            'message'=>"Invalid",
            //         ]);

            //     }
            //     return response()->json([
            //         'status'=>200,
            //        'message'=>"User loged in successfully",
            //         'access_token'=>$token
            //     ]);

            // }
}
