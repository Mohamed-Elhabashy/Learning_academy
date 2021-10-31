<?php

namespace App\Http\Controllers\Front;
use App\Models\course;
use App\Models\cat;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function cat($id){
        $data['cat']=cat::findOrFail($id);
        $data['courses']=course::where('cat_id',$id)->paginate(6);
        return View('Front/courses/cat')->with($data);
    }
    public function show($id , $c_id){
        $data['course']=course::findOrFail($c_id);
        return View('Front/courses/show')->with($data);
    }
}
