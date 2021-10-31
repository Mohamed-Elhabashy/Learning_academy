<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Models\course;
use App\Models\student;
use App\Models\trainer;
use Illuminate\Http\Request;
class HomeController extends Controller
{
    public function index(){
        $data['courses']=course::Select('id','name','small_desc','cat_id','trainer_id','img','price')
        ->orderBy('id','desc')
        ->take(3)
        ->get();
        $data['courses_count']=course::count();
        $data['students_count']=student::count();
        $data['trainers_count']=trainer::count();
        return View('Front/index')->with($data);
    }
}
