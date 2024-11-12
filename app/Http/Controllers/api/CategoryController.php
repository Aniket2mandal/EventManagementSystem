<?php

namespace App\Http\Controllers\api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Event Mnagement System API",
 *      description="Event management API",
 *      @OA\Contact(
 *          email="support@example.com"
 *      )
 * )
 *
 *  * @OA\SecurityScheme(
 *     securityScheme="bearer_token",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT"
 * )
 * @OA\Tag(
 *     name="Category",
 *     description="Category related endpoints"
 * )
 */


class CategoryController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/categories/index",
     *     summary="Get list of categories",
     * tags={"Category"},
     *     security={{"bearer_token":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="integer"),
     *             @OA\Property(property="categories", type="array", @OA\Items(type="object"))
     *         )
     *     )
     * )
     */

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

   /**
     * @OA\Post(
     *     path="/api/categories/store",
     *     summary="Store a new category",
     * tags={"Category"},
     *   security={{"bearer_token":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(property="name", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Category created successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="integer"),
     *             @OA\Property(property="message", type="string")
     *         )
     *     )
     * )
     */


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

  /**
     * @OA\Get(
     *     path="/api/categories/show/{id}",
     *     summary="Get category by ID",
     * tags={"Category"},
     *   security={{"bearer_token":{}}},
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
     *             @OA\Property(property="category", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Data not found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="integer"),
     *             @OA\Property(property="message", type="string")
     *         )
     *     )
     * )
     */

    public function show($id){
        $category=Category::find($id);
        if($category){
            // dd($category);
            return response()->json([
              'status'=>200,
              'category'=>$category
            ],200);
        }
        else{
            return response()->json([
                'status'=>400,
                'message'=>'Data not available found'
              ],400);
        }
    }

 /**
     * @OA\Put(
     *     path="/api/categories/update/{id}",
     *     summary="Update a category",
     * tags={"Category"},
     *   security={{"bearer_token":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(property="name", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Category updated successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="integer"),
     *             @OA\Property(property="message", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Category not found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="integer"),
     *             @OA\Property(property="message", type="string")
     *         )
     *     )
     * )
     */

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


    /**
     * @OA\Delete(
     *     path="/api/categories/delete/{id}",
     *     summary="Delete a category",
     * tags={"Category"},
     *   security={{"bearer_token":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Category deleted successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="integer"),
     *             @OA\Property(property="message", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Category not found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="integer"),
     *             @OA\Property(property="message", type="string")
     *         )
     *     )
     * )
     */

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
