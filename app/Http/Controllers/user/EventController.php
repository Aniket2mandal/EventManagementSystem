<?php

namespace App\Http\Controllers\user;

use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
   public function index(){
    $event_data=Event::all();
    $categories = Category::pluck('name');
    $categoriesid = Category::get();
    return view('USER.event.index',compact('event_data','categories','categoriesid'));
   }

   public function create(){
    $categories=Category::all();
    return view('USER.event.create',compact('categories'));
   }

   public function store(Request $request){
    try{
    $request->validate([
        'title'=>'required|string',
        'description'=>'required|string',
        'date'=>'required|date',
        'location'=>'required|string',
        'category_id'=>'required|integer',
        ]);

        // dd($request);
        $event=new Event();
        $event->title=$request->title;
        $event->description=$request->description;
        $event->date=$request->date;
        $event->location=$request->location;
        $event->category_id=$request->category_id;
        $event->save();
          // TO RETURN TO ANOTHER PAGE AFTER INSERTING WITH SUCESS MESSAGE
         return redirect()->route('events.index')
            ->with('success','Event'."\t".$event->title ."\t".'created sucessfully');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }

   }

   public function edit($id){
    $event_data=Event::where('id',$id)->first();
    $categories=Category::get();
    return view('USER.event.edit',compact('event_data','categories'));
   }

   public function update(Request $request,$id){
    $request->validate([
        'title'=>'required|string',
        'description'=>'required|string',
        'date'=>'required|date',
        'location'=>'required|string',
        'category_id'=>'required|integer',
        ]);
        $event_data=Event::where('id',$id)->get();
        foreach($event_data as $event){
        $event->title=$request->title;
        $event->description=$request->description;
        $event->date=$request->date;
        $event->location=$request->location;
        $event->category_id=$request->category_id;
        $event->save();
        }
          // TO RETURN TO ANOTHER PAGE AFTER INSERTING WITH SUCESS MESSAGE
          return redirect()->route('events.index')
           ->with('success','Event'."\t".$event->title ."\t".'updated sucessfully');
   }

   public function delete($id){
    $event_del=Event::where('id',$id)->first();
    if ($event_del) {
        $event_del->delete();
        return redirect()->route('events.index')->with('success', 'Event'."\t".$event_del->title ."\t".' deleted successfully!');
    } else {
        return redirect()->route('events.index')->with('error', $event_del->title."\t". 'not found!');
    }
   }
}
