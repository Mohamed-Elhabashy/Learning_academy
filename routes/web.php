<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\CourseController;
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

Route::get('/',[HomeController::class,'index'])->name('front.homepage');
Route::get('/cat/{id}',[CourseController::class,'cat'])->name('front.course.cat');
Route::get('/cat/{id}/course/{c_id}',[CourseController::class,'show'])->name('front.course.show');
Route::get('/Contact',[ContactController::class,'index'])->name('front.Contact');
