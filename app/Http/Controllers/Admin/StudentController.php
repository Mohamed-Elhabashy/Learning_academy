<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\StoreStudentRequest;
use App\Http\Requests\Student\UpdateStudentRequest;
use App\Models\course;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index()
    {
        $students = student::select('id', 'name', 'email', 'spec')->orderBy('id', 'DESC')->get();

        return View('admin.students.index', ['students' => $students]);
    }

    public function create()
    {
        return View('admin.students.create');
    }

    public function store(StoreStudentRequest $request)
    {
        Student::create($request->all());

        return redirect()->route('admin.students.index');
    }

    public function edit(Student $student)
    {
        return View('admin.students.edit', ['student' => $student]);
    }

    public function update(UpdateStudentRequest $request, Student $student)
    {
        $student->update($request->all());

        return redirect()->route('admin.students.index');
    }

    public function delete(Student $student)
    {
        $student->delete();

        return back();
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
            'status' => 'approve',
        ]);

        return back();
    }

    public function RejectCourses($id, $c_id)
    {
        DB::table('course_student')->where('student_id', $id)->where('course_id', $c_id)->update([
            'status' => 'rejected',
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
            'course_id' => 'required|exists:courses,id',
        ]);
        DB::table('course_student')->insert([
            'student_id' => $data['student_id'],
            'course_id' => $data['course_id'],
        ]);

        return redirect(route('admin.students.ShowCourses', $data['student_id']));
    }
}
