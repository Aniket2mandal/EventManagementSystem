<?php

namespace App\Http\Controllers\user;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index(){
        $category_data=Category::get();
        return view('USER.category.index',compact('category_data'));
    }

    public function create(){
        return view('USER.category.create');
    }

    public function store(Request $request){
        $request->validate([
            'name'=>'required|string',
            ]);
            $category=new Category();
            $category->name=$request->name;
            $category->save();
              // TO RETURN TO ANOTHER PAGE AFTER INSERTING WITH SUCESS MESSAGE
              return redirect()->route('categories.index')
               ->with('success','Category'."\t".$category->name ."\t".'created sucessfully');
       }

       public function edit($id){
        $category_data=Category::where('id',$id)->first();
        return view('USER.category.edit',compact('category_data'));
       }


       public function update(Request $request,$id){
        $request->validate([
            'name'=>'required|string',
            ]);
            // echo $request->CategoryName;
            $category=Category::where('id',$id)->get();
            foreach($category as $data){
            $data->name=$request->name;
            $data->save();
            }
      // TO RETURN TO ANOTHER PAGE AFTER INSERTING WITH SUCESS MESSAGE
      return redirect()->route('categories.index')->with('success','Category'."\t".$data->name ."\t".'updated sucessfully');
       }


       public function delete($id){
        $category_del=Category::where('id',$id)->first();
        if ($category_del) {
            $category_del->delete();
            return redirect()->route('categories.index')->with('success', 'Category'."\t".$category_del->name ."\t".' deleted successfully!');
        } else {
            return redirect()->route('categories.index')->with('error', $category_del->name ."\t". 'not found!');
        }
       }
}
