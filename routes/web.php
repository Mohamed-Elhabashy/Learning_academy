<?php

use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\StudentController;
use App\Http\Controllers\admin\TrainerController;
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
    Route::get('/dashboard', [App\Http\Controllers\admin\HomeController::class, 'index'])->name('admin.homepage');
    Route::get('/dashboard/logout', [AuthController::class, 'logout'])->name('admin.logout');

    Route::prefix('dashboard')->as('admin.')->group(function () {
        // ================== Start Students Routes =====================================
        Route::resource('students', StudentController::class);

        Route::prefix('students')->group(function () {
            Route::get('ShowCourses/{id}', [StudentController::class, 'ShowCourses'])->name('ShowCourses');
            Route::get('{id}/ApproveCourses/{c_id}', [StudentController::class, 'ApproveCourses'])->name('approvecourse');
            Route::get('{id}/RejectCourses/{c_id}', [StudentController::class, 'RejectCourses'])->name('rejectedcourse');
            Route::get('{id}/AddToCourse', [StudentController::class, 'AddToCourse'])->name('AddToCourse');
            Route::post('StoreStudentCourse', [StudentController::class, 'StoreStudentCourse'])->name('StoreStudentCourse');
        });
        // ================== End Students Routes =====================================

        // ================== Start Categories Routes =====================================
        Route::resource('categories', CategoryController::class);
        // ================== Start Categories Routes =====================================
    });

    Route::get('/dashboard/trainer', [TrainerController::class, 'index'])->name('admin.trainer.index');
    Route::get('/dashboard/trainer/create', [TrainerController::class, 'create'])->name('admin.trainer.create');
    Route::post('/dashboard/trainer/store', [TrainerController::class, 'store'])->name('admin.trainer.store');
    Route::get('/dashboard/trainer/edit/{id}', [TrainerController::class, 'edit'])->name('admin.trainer.edit');
    Route::post('/dashboard/trainer/update', [TrainerController::class, 'update'])->name('admin.trainer.update');
    Route::get('/dashboard/trainer/delete/{id}', [TrainerController::class, 'delete'])->name('admin.trainer.delete');

    Route::get('/dashboard/course', [App\Http\Controllers\admin\CourseController::class, 'index'])->name('admin.courses.index');
    Route::get('/dashboard/course/create', [App\Http\Controllers\admin\CourseController::class, 'create'])->name('admin.courses.create');
    Route::post('/dashboard/course/store', [App\Http\Controllers\admin\CourseController::class, 'store'])->name('admin.courses.store');
    Route::get('/dashboard/course/edit/{id}', [App\Http\Controllers\admin\CourseController::class, 'edit'])->name('admin.courses.edit');
    Route::post('/dashboard/course/update', [App\Http\Controllers\admin\CourseController::class, 'update'])->name('admin.courses.update');
    Route::get('/dashboard/course/delete/{id}', [App\Http\Controllers\admin\CourseController::class, 'delete'])->name('admin.courses.delete');
});
