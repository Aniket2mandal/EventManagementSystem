<?php

namespace App\Http\Controllers\user;

use App\Models\Event;
use App\Models\Attendee;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontController extends Controller
{
    public function index(){
        $event = Event::count();
        $category = Category::count();
        $attendee = Attendee::count();
       
        // dd($event.$category.$Attendee);
        // dd(compact('event', 'attendee', 'category')); // This will dump the data and stop execution
         return view('USER.index',compact('event','category','attendee'));
        // echo "hello";
    }

}
