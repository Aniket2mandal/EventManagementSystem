<?php

namespace App\Http\Controllers\api;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventController extends Controller
{


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
