<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AbishekController extends Controller
{
    public function index(){
        return view("Admin.abishek");
    }

    public function create(){
        return view ('Admin.form');
    }
}
