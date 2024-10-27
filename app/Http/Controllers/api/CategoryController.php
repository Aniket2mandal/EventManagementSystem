<?php

namespace App\Http\Controllers\api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index(){
        $category=Category::all();
        if($category->count()>0){
        $data=[
            'status'=>200,
            'categories'=>$category
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
              ]);
                $category=Category::create([
                    'name'=>$request->name,
                ]);

              if($category){
                return response()->json([
                    'status'=>200,
                    'message'=>'Category created sucessfully'
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
        $category=Category::find($id);
        if($category){
            return response()->json([
              'status'=>200,
              'category'=>$category
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
              ]);

                $category=Category::find($id);

                if($category){
                $category->update([
                    'name'=>$request->name,
                ]);
                return response()->json([
                 'status'=>200,
                 'message'=>'Category updated sucessfully'
                ],200);
            }
            else{
                return response()->json([
                    'status'=>404,
                    'message'=>'Category not found'
                   ],404);
            }
    }


    public function destroy($id){
        $category=Category::find($id);
        if($category){
             $category->delete();
             return response()->json([
                'status'=>200,
                'message'=>'Category deleted sucessfully'
            ],200);
        }
        else{
            return response()->json([
                'status'=>404,
                'message'=>'Category not found'
            ],404);
        }
    }

}
