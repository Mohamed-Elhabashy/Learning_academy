<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\student;
use Illuminate\Http\Request;

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
            'name' => 'required|string|max:191',
            'email' => 'nullable|email|max:191|unique:students',
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
            'name' => 'required|string|max:191',
            'email' => 'nullable|email|max:191|unique:students',
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
}
