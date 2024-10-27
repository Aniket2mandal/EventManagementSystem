<?php

namespace App\Http\Controllers\api;

use App\Models\Attendee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttendeeController extends Controller
{
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
