<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CatController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\CourseController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\MessageController;
use Illuminate\Support\Facades\Route;

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
Route::get('/', [HomeController::class, 'index'])->name('front.homepage');
Route::get('/cat/{id}', [CourseController::class, 'cat'])->name('front.course.cat');
Route::get('/cat/{id}/course/{c_id}', [CourseController::class, 'show'])->name('front.course.show');
Route::get('/Contact', [ContactController::class, 'index'])->name('front.Contact');
Route::post('/message/newsletter', [MessageController::class, 'newsletter'])->name('front.message.newsletter');
Route::post('/message/contact', [MessageController::class, 'contact'])->name('front.message.contact');
Route::post('/message/enroll', [MessageController::class, 'enroll'])->name('front.message.enroll');

Route::get('/dashboard/login', [AuthController::class, 'login'])->name('admin.login');
Route::post('/dashboard/SubmitLogin', [AuthController::class, 'SubmitLogin'])->name('submit.login');
Route::middleware('adminAuth:admin')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin.homepage');
    Route::get('/dashboard/logout', [AuthController::class, 'logout'])->name('admin.logout');
    Route::get('/dashboard/cats', [CatController::class, 'index'])->name('admin.cats.index');
    Route::get('/dashboard/cats/create', [CatController::class, 'create'])->name('admin.cats.create');
    Route::post('/dashboard/cats/store', [CatController::class, 'store'])->name('admin.cats.store');
    Route::get('/dashboard/cats/edit/{id}', [CatController::class, 'edit'])->name('admin.cats.edit');
    Route::post('/dashboard/cats/update', [CatController::class, 'update'])->name('admin.cats.update');
    Route::get('/dashboard/cats/delete/{id}', [CatController::class, 'delete'])->name('admin.cats.delete');
});
