<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\course;
use App\Models\student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index()
    {
        $data['students'] = student::select('id', 'name', 'email', 'spec')->orderBy('id', 'DESC')->get();
        return View('Admin.students.index')->with($data);
    }

    public function create()
    {
        return View('Admin.students.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'nullable|string|max:191',
            'email' => 'required|email|max:191|unique:students',
            'spec' => 'nullable|string|max:191'
        ]);
        student::create($data);
        return redirect(route('admin.students.index'));
    }

    public function edit($id)
    {
        $data['student'] = student::findOrFail($id);
        return View('Admin.students.edit')->with($data);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'name' => 'nullable|string|max:191',
            'email' => 'required|email|max:191|unique:students',
            'spec' => 'nullable|string|max:191'
        ]);
        student::findOrFail($request->id)->update($data);
        return redirect(route('admin.students.index'));
    }

    public function delete($id)
    {
        student::findOrFail($id)->delete();
        return redirect(route('admin.students.index'));
    }

    public function ShowCourses($id)
    {
        $data['student_id'] = $id;
        $data['courses'] = student::findOrFail($id)->courses;
        return View('admin.students.ShowCourses')->with($data);
    }

    public function ApproveCourses($id, $c_id)
    {
        DB::table('course_student')->where('student_id', $id)->where('course_id', $c_id)->update([
            'status' => 'approve'
        ]);
        return back();
    }

    public function RejectCourses($id, $c_id)
    {
        DB::table('course_student')->where('student_id', $id)->where('course_id', $c_id)->update([
            'status' => 'rejected'
        ]);
        return back();
    }

    public function AddToCourse($id)
    {
        $data['student_id'] = $id;
        $data['courses'] = course::select('id', 'name')->get();
        return View('admin.students.AddStudentToCourse')->with($data);
    }

    public function StoreStudentCourse(Request $request)
    {
        $data = $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id'
        ]);
        DB::table('course_student')->insert([
            'student_id' => $data['student_id'],
            'course_id' => $data['course_id']
        ]);
        return redirect(route('admin.students.ShowCourses', $data['student_id']));
    }
}
