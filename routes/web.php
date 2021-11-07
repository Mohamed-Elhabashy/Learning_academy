<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CatController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\TrainerController;
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

    Route::get('/dashboard/trainer', [TrainerController::class, 'index'])->name('admin.trainer.index');
    Route::get('/dashboard/trainer/create', [TrainerController::class, 'create'])->name('admin.trainer.create');
    Route::post('/dashboard/trainer/store', [TrainerController::class, 'store'])->name('admin.trainer.store');
    Route::get('/dashboard/trainer/edit/{id}', [TrainerController::class, 'edit'])->name('admin.trainer.edit');
    Route::post('/dashboard/trainer/update', [TrainerController::class, 'update'])->name('admin.trainer.update');
    Route::get('/dashboard/trainer/delete/{id}', [TrainerController::class, 'delete'])->name('admin.trainer.delete');

    Route::get('/dashboard/course', [App\Http\Controllers\Admin\CourseController::class, 'index'])->name('admin.courses.index');
    Route::get('/dashboard/course/create', [App\Http\Controllers\Admin\CourseController::class, 'create'])->name('admin.courses.create');
    Route::post('/dashboard/course/store', [App\Http\Controllers\Admin\CourseController::class, 'store'])->name('admin.courses.store');
    Route::get('/dashboard/course/edit/{id}', [App\Http\Controllers\Admin\CourseController::class, 'edit'])->name('admin.courses.edit');
    Route::post('/dashboard/course/update', [App\Http\Controllers\Admin\CourseController::class, 'update'])->name('admin.courses.update');
    Route::get('/dashboard/course/delete/{id}', [App\Http\Controllers\Admin\CourseController::class, 'delete'])->name('admin.courses.delete');

    Route::get('/dashboard/student', [StudentController::class, 'index'])->name('admin.students.index');
    Route::get('/dashboard/student/create', [StudentController::class, 'create'])->name('admin.students.create');
    Route::post('/dashboard/student/store', [StudentController::class, 'store'])->name('admin.students.store');
    Route::get('/dashboard/student/edit/{id}', [StudentController::class, 'edit'])->name('admin.students.edit');
    Route::post('/dashboard/student/update', [StudentController::class, 'update'])->name('admin.students.update');
    Route::get('/dashboard/student/delete/{id}', [StudentController::class, 'delete'])->name('admin.students.delete');
    Route::get('/dashboard/student/ShowCourses/{id}', [StudentController::class, 'ShowCourses'])->name('admin.students.ShowCourses');
    Route::get('/dashboard/student/{id}/ApproveCourses/{c_id}', [StudentController::class, 'ApproveCourses'])->name('admin.students.approvecourse');
    Route::get('/dashboard/student/{id}/RejectCourses/{c_id}', [StudentController::class, 'RejectCourses'])->name('admin.students.rejectedcourse');
    Route::get('/dashboard/student/{id}/AddToCourse', [StudentController::class, 'AddToCourse'])->name('admin.students.AddToCourse');
    Route::post('/dashboard/student/StoreStudentCourse', [StudentController::class, 'StoreStudentCourse'])->name('admin.students.StoreStudentCourse');
});
