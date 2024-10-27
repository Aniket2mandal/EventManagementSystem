<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\EventController;
use App\Http\Controllers\api\AttendeeController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\Authentication\AuthController;
use App\Http\Controllers\Authentication\ApiAuthController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Route::post('register',[AuthController::class,'register'])->name('user.register');
 Route::post('apilogin',[ApiAuthController::class,'login'])->name('user.apilogin');
Route::middleware('auth:sanctum')->group(function () {
// CATEGORY
Route::get('categories/index', [CategoryController::class, 'index']);
Route::post('categories/store',[CategoryController::class,'store']);
Route::get('categories/show/{id}',[CategoryController::class,'show']);
Route::put('categories/update/{id}',[CategoryController::class,'update']);
Route::delete('categories/delete/{id}',[CategoryController::class,'destroy']);

// EVENT
Route::get('events/index', [EventController::class, 'index']);
Route::post('events/store',[EventController::class,'store']);
Route::get('events/show/{id}',[EventController::class,'show']);
Route::put('events/update/{id}',[EventController::class,'update']);
Route::delete('events/delete/{id}',[EventController::class,'destroy']);


// ATTENDEE
Route::get('attendees/index', [AttendeeController::class, 'index']);
Route::post('attendees/store',[AttendeeController::class,'store']);
Route::get('attendees/show/{id}',[AttendeeController::class,'show']);
Route::put('attendees/update/{id}',[AttendeeController::class,'update']);
Route::delete('attendees/delete/{id}',[AttendeeController::class,'destroy']);

Route::post('apilogout',[ApiAuthController::class,'Apilogout'])->name('user.Apilogout');
});
