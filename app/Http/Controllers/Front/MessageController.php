<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Newsletter;
use App\Models\student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function newsletter(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email|max:191'
        ]);
        Newsletter::create($data);
        return back();
    }

    public function contact(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'subject' => 'string|max:191',
            'message' => 'required|string'
        ]);
        Message::create($data);
        return back();
    }

    public function enroll(Request $request)
    {
        $data = $request->validate([
            'name' => 'nullable|string|max:191',
            'email' => 'required|email|max:191',
            'spec' => 'nullable|string|max:191',
            'course_id' => 'required|exists:courses,id'
        ]);
        $old_student = student::select('id')->where('email', $data['email'])->first();
        if ($old_student == null) {
            $_student = student::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'spec' => $data['spec'],
            ]);
            $student_id = $_student->id;
        } else {
            $student_id = $old_student->id;
            if ($data['name'] !== null) {
                $old_student->update(['name' => $data['name']]);
            }
            if ($data['spec'] !== null) {
                $old_student->update(['spec' => $data['spec']]);
            }
        }
        DB::table('course_student')->insert([
            'course_id' => $data['course_id'],
            'student_id' => $student_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return back();
    }
}
