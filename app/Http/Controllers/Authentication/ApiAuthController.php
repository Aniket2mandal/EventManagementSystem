<?php

namespace App\Http\Controllers\Authentication;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ApiAuthController extends Controller
{


    /**
     * @OA\Post(
     *     path="/api/register",
     *     tags={"Authentication"},
     *     summary="Register a new user",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name","email","password","password_confirmation"},
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="email", type="string", format="email"),
     *             @OA\Property(property="password", type="string", format="password"),
     *             @OA\Property(property="password_confirmation", type="string", format="password")
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User registered successfully"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */

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
if($user){
                // return response()->json(['message' => 'User successfully registered'], 201);
                return response()->json([
                    'status' => 200,
                    'message' => "User registered successfully",
                    // 'access_token' => $token,
                ]);
            }
            else{
                return response()->json([
                    'status' => 404,
                    'message' => "Something went wrong",
                    // 'access_token' => $token,
                ]);
            }
            }

             /**
     * @OA\Post(
     *     path="/api/apilogin",
     *     tags={"Authentication"},
     *     summary="Login a user",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email","password"},
     *             @OA\Property(property="email", type="string", format="email"),
     *             @OA\Property(property="password", type="string", format="password")
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User logged in successfully"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     )
     * )
     */

    public function login(Request $request){

        $validate=$request->validate([
            'email'=>'required|email',
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

/**
 * @OA\SecurityScheme(
 *     securityScheme="bearer_token",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT"
 * )
 */

   /**
 * @OA\Post(
 *     path="/api/apilogout",
 *     summary="Logout user",
 *     description="Logout authenticated user and invalidate the token",
 *     tags={"Authentication"},
 *     security={{"bearer_token":{}}},
 *     @OA\Response(
 *         response=200,
 *         description="User logged out successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="status", type="integer"),
 *             @OA\Property(property="message", type="string")
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized. User not logged in.",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="status", type="integer"),
 *             @OA\Property(property="message", type="string")
 *         )
 *     )
 * )
 */
public function Apilogout(Request $request)
{ 
    // Delete the user's current access token
    $user = $request->user();
    $user->tokens()->delete();
//   $request->user()->currentAccessToken()->delete();

    // Return a success response

    return response()->json([
        'status' => 200,
        'message' => "User logged out successfully",
    ]);

}

}
