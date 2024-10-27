<?php

namespace App\Http\Controllers\user;

use App\Models\Event;
use App\Models\Attendee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttendeController extends Controller
{
    public function index(){
        $attendee=Attendee::all();
        return view('USER.attendes.index',compact('attendee'));
    }

    public function create(){
        $events=Event::all();
        // dd($events->name);
        return view('USER.attendes.create',compact('events'));
    }

    public function store(Request $request){
        $request->validate([
            'name'=>'required|string',
            'email'=>'required|string',
            'event_id'=>'required|integer',
            ]);
            $attendee=new Attendee();
            $attendee->name=$request->name;
            $attendee->email=$request->email;
            $attendee->event_id=$request->event_id;
            $attendee->save();
              // TO RETURN TO ANOTHER PAGE AFTER INSERTING WITH SUCESS MESSAGE
              return redirect()->route('attendes.index')
               ->with('success','Attendee'."\t".$attendee->name ."\t".'created sucessfully');
       }

       public function edit($id){
        $attendee_data=Attendee::where('id',$id)->first();
        $events=Event::all();
        return view('USER.attendes.edit',compact('attendee_data','events'));
       }


       public function update(Request $request,$id){
        $request->validate([
            'name'=>'required|string',
            'email'=>'required|string',
            'event_id'=>'required|integer',
            ]);
            // dd($request->event_id);
            // echo $request->CategoryName;
            $attendee_data=Attendee::where('id',$id)->get();
            foreach($attendee_data as $attendee){
                $attendee->name=$request->name;
                $attendee->email=$request->email;
                $attendee->event_id=$request->event_id;
                $attendee->save();
            }
      // TO RETURN TO ANOTHER PAGE AFTER INSERTING WITH SUCESS MESSAGE
     return redirect()->route('attendes.index')->with('success','Attendee'."\t".$attendee->name ."\t".'updated sucessfully');
       }

       public function delete($id){
        $attendee_del=Attendee::where('id',$id)->first();
        if ($attendee_del) {
            $attendee_del->delete();
            return redirect()->route('attendes.index')->with('success', 'Attendee'."\t".$attendee_del->name ."\t".' deleted successfully!');
        } else {
            return redirect()->route('attendes.index')->with('error', $attendee_del->name  ."\t". 'not found!');
        }
       }

}
