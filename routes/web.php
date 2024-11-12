<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\user\EventController;
use App\Http\Controllers\user\FrontController;
use App\Http\Controllers\user\AttendeController;
use App\Http\Controllers\user\ProfileController;
use App\Http\Controllers\user\CategoryController;
use App\Http\Controllers\Authentication\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('USER.auth.login');
});

// Auth::routes();

Route::get('registerindex',[AuthController::class,'registerindex'])->name('user.registerindex');
Route::post('register',[AuthController::class,'register'])->name('user.register');
Route::get('loginindex',[AuthController::class,'loginindex'])->name('user.loginindex');
Route::post('login',[AuthController::class,'login'])->name('user.login');


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['prefix'=>'user'],function(){
    Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [FrontController::class, 'index'])->name('user.dashboard');
    // Route::get('/home', [HomeController::class, 'index'])->name('home');


    // EVENT
    Route::get('events/index', [EventController::class, 'index'])->name('events.index');
    Route::get('events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('events/store', [EventController::class, 'store'])->name('events.store');
    Route::get('events/edit/{id}',[EventController::class,'edit'])->name('events.edit');
    Route::post('events/update/{id}',[EventController::class,'update'])->name('events.update');
    Route::get('events/delete/{id}',[EventController::class,'delete'])->name('events.delete');


    // ATTENDES
    Route::get('attendes/index', [AttendeController::class, 'index'])->name('attendes.index');
    Route::get('attendes/create', [AttendeController::class, 'create'])->name('attendes.create');
    Route::post('attendes/store', [AttendeController::class, 'store'])->name('attendes.store');
    Route::get('attendes/edit/{id}',[AttendeController::class,'edit'])->name('attendes.edit');
    Route::post('attendes/update/{id}',[AttendeController::class,'update'])->name('attendes.update');
    Route::get('attendes/delete/{id}',[AttendeController::class,'delete'])->name('attendes.delete');

    // CATEGORY
    Route::get('categories/index', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('categories/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('categories/edit/{id}',[CategoryController::class,'edit'])->name('categories.edit');
    Route::post('categories/update/{id}',[CategoryController::class,'update'])->name('categories.update');
    Route::get('categories/delete/{id}',[CategoryController::class,'delete'])->name('categories.delete');

    // PROFILE
    Route::get('profile',[ProfileController::class,'index'])->name('user.profile');
    Route::get('logout',[AuthController::class,'logout'])->name('user.logout');
 });
});
