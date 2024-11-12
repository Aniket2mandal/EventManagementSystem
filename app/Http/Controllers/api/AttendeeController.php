<?php

namespace App\Http\Controllers\api;

use App\Models\Attendee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttendeeController extends Controller
{

 /**
     * @OA\Get(
     *     path="/api/attendees/index",
     *     summary="Get list of attendees",
     *     tags={"Attendee"},
     *     security={{"bearer_token":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="integer"),
     *             @OA\Property(property="attendees", type="array", @OA\Items(type="object"))
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No Record Found"
     *     )
     * )
     */

    public function index(){
        $attendee=Attendee::all();
        if($attendee->count()>0){
        $data=[
            'status'=>200,
            'attendees'=>$attendee
        ];
        return response()->json($data,200);
    }
        else{
            $data=[
                'status'=>404,
                'message'=>'No Record Found'
            ];
            return response()->json($data,404);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/attendees/store",
     *     summary="Store a new attendee",
     *     tags={"Attendee"},
     *     security={{"bearer_token":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="email", type="string"),
     *             @OA\Property(property="event_id", type="integer")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Attendee created successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="integer"),
     *             @OA\Property(property="message", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Something went wrong"
     *     )
     * )
     */

    public function store(Request $request){
        $request->validate([
            'name'=>'required|string',
            'email'=>'required|string',
            'event_id'=>'required|integer',
              ]);
                $attendee=Attendee::create([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'event_id'=>$request->event_id,
                ]);

              if($attendee){
                return response()->json([
                    'status'=>200,
                    'message'=>'attendee created sucessfully'
                ],200);
              }
              else{
                return response()->json([
                    'status'=>500,
                    'message'=>'Something went wrong'
                ],500);
              }
    }

     /**
     * @OA\Get(
     *     path="/api/attendees/show/{id}",
     *     summary="Show an attendee",
     *     tags={"Attendee"},
     *     security={{"bearer_token":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="integer"),
     *             @OA\Property(property="attendee", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Data not found"
     *     )
     * )
     */

    public function show($id){
        $attendee=Attendee::find($id);
        if($attendee){
            return response()->json([
              'status'=>200,
              'category'=>$attendee
            ],200);
        }
        else{
            return response()->json([
                'status'=>400,
                'message'=>'Data not found'
              ],400);
        }
    }


    /**
     * @OA\Put(
     *     path="/api/attendees/update/{id}",
     *     summary="Update an attendee",
     *     tags={"Attendee"},
     *     security={{"bearer_token":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="email", type="string"),
     *             @OA\Property(property="event_id", type="integer")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Attendee updated successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="integer"),
     *             @OA\Property(property="message", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Attendee not found"
     *     )
     * )
     */


    public function update(Request $request,int $id){
        $request->validate([
            'name'=>'required|string',
            'email'=>'required|string',
            'event_id'=>'required|integer',
              ]);

                $attendee=Attendee::find($id);

                if($attendee){
                $attendee->update([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'event_id'=>$request->event_id,
                ]);
                return response()->json([
                 'status'=>200,
                 'message'=>'attendee updated sucessfully'
                ],200);
            }
            else{
                return response()->json([
                    'status'=>404,
                    'message'=>'attendee not found'
                   ],404);
            }
    }

    /**
     * @OA\Delete(
     *     path="/api/attendees/delete/{id}",
     *     summary="Delete an attendee",
     *     tags={"Attendee"},
     *     security={{"bearer_token":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Attendee deleted successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="integer"),
     *             @OA\Property(property="message", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Attendee not found"
     *     )
     * )
     */

    public function destroy($id){
        $attendee=Attendee::find($id);
        if($attendee){
             $attendee->delete();
             return response()->json([
                'status'=>200,
                'message'=>'attendee deleted sucessfully'
            ],200);
        }
        else{
            return response()->json([
                'status'=>404,
                'message'=>'attendee not found'
            ],404);
        }
    }
}
