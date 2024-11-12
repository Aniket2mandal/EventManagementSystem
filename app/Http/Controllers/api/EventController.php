<?php

namespace App\Http\Controllers\api;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventController extends Controller
{


      /**
     * @OA\Get(
     *     path="/api/events/index",
     *     summary="Get list of events",
     *     tags={"Event"},
     *     security={{"bearer_token":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="integer"),
     *             @OA\Property(property="events", type="array", @OA\Items(type="object"))
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No Record Found"
     *     )
     * )
     */

    public function index(){
        $event=Event::all();
        if($event->count()>0){
        $data=[
            'status'=>200,
            'events'=>$event
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
     *     path="/api/events/store",
     *     summary="Store a new event",
     *     tags={"Event"},
     *     security={{"bearer_token":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="title", type="string"),
     *             @OA\Property(property="description", type="string"),
     *             @OA\Property(property="date", type="string", format="date"),
     *             @OA\Property(property="location", type="string"),
     *             @OA\Property(property="category_id", type="integer")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Event created successfully",
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
            'title'=>'required|string',
            'description'=>'required|string',
            'date'=>'required|date',
            'location'=>'required|string',
            'category_id'=>'required|integer',
              ]);
                $event=Event::create([
                    'title'=>$request->title,
                    'description'=>$request->description,
                    'date'=>$request->date,
                    'location'=>$request->location,
                    'category_id'=>$request->category_id,
                ]);

              if($event){
                return response()->json([
                    'status'=>200,
                    'message'=>'event created sucessfully'
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
     *     path="/api/events/show/{id}",
     *     summary="Show an event",
     *     tags={"Event"},
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
     *             @OA\Property(property="event", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Data not found"
     *     )
     * )
     */

    public function show($id){
        $event=Event::find($id);
        if($event){
            return response()->json([
              'status'=>200,
              'event'=>$event
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
     *     path="/api/events/update/{id}",
     *     summary="Update an event",
     *     tags={"Event"},
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
     *             @OA\Property(property="title", type="string"),
     *             @OA\Property(property="description", type="string"),
     *             @OA\Property(property="date", type="string", format="date"),
     *             @OA\Property(property="location", type="string"),
     *             @OA\Property(property="category_id", type="integer")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Event updated successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="integer"),
     *             @OA\Property(property="message", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Event not found"
     *     )
     * )
     */


    public function update(Request $request,int $id){
        $request->validate([
            'title'=>'required|string',
            'description'=>'required|string',
            'date'=>'required|date',
            'location'=>'required|string',
            'category_id'=>'required|integer',
              ]);
                $event=Event::find($id);
                if($event){
                $event->update([
                    'title'=>$request->title,
                    'description'=>$request->description,
                    'date'=>$request->date,
                    'location'=>$request->location,
                    'category_id'=>$request->category_id,
                ]);
                return response()->json([
                 'status'=>200,
                 'message'=>'event updated sucessfully'
                ],200);
            }
            else{
                return response()->json([
                    'status'=>404,
                    'message'=>'event not found'
                   ],404);
            }
    }


     /**
     * @OA\Delete(
     *     path="/api/events/{id}",
     *     summary="Delete an event",
     *     tags={"Event"},
     *     security={{"bearer_token":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Event deleted successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="integer"),
     *             @OA\Property(property="message", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Event not found"
     *     )
     * )
     */

    public function destroy($id){
        $event=Event::find($id);
        if($event){
             $event->delete();
             return response()->json([
                'status'=>200,
                'message'=>'event deleted sucessfully'
            ],200);
        }
        else{
            return response()->json([
                'status'=>404,
                'message'=>'event not found'
            ],404);
        }
    }



}
