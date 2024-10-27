<?php

namespace App\Http\Controllers\Authentication;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ApiAuthController extends Controller
{
    public function login(Request $request){

        $validate=$request->validate([
            'email'=>'required|string',
            'password'=>'required',
              ]);

        $user=User::where('email',$request->email)->first();

        if($user && Hash::check($request->password,$user->password)){


                $token=$user->createToken('Access Token')->plainTextToken;;
                return response()->json([
                    'status' => 200,
                    'message' => "User logged in successfully",
                    'access_token' => $token,
                ]);
        }
        else{
                return response()->json([
                    'status' => 404,
                    'message' => "unable to login",
                ]);

}
    }


      public function Apilogout(Request $request){
                $logout=Auth::logout();
                if($logout){
                    $request->user()->currentAccessToken()->delete();
                    return response()->json([
                        'status'=>200,
                       'message'=>"User loged in successfully",
                        'access_token'=>$token
                    ]);
                }
                return response()->json([
                    'status' => 401,
                    'message' => "Unauthorized. User not logged in.",
                ], 401);
            }
}
