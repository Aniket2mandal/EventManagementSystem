<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(){
        // $user_data=User::
        $user = Auth::user();
        // dd($user->name);
        return view('USER.profile.index',compact('user'));
    }
}
