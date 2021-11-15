<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\cat;
use App\Models\course;
use App\Models\trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class CourseController extends Controller
{
    public function index()
    {
        $data['courses'] = course::select('id', 'name', 'price', 'img')->orderBy('id', 'DESC')->get();
        return View('admin.courses.index')->with($data);
    }

    public function create()
    {
        $data['categories'] = cat::select('id', 'name')->get();
        $data['trainers'] = trainer::select('id', 'name')->get();
        return View('admin.courses.create')->with($data);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:50',
            'small_desc' => 'required|string|max:191',
            'desc' => 'required|string',
            'price' => 'required|integer',
            'cat_id' => 'required|exists:categories,id',
            'trainer_id' => 'required|exists:trainers,id',
            'img' => 'required|image|mimes:jpg,jpeg,png'
        ]);
        $new_name_image = $data['img']->hashName();
        Image::make($data['img'])->resize(970, 520)->save(public_path('Uploads/Courses/'.$new_name_image));
        $data['img'] = $new_name_image;
        course::create($data);
        return redirect(route('admin.courses.index'));
    }

    public function edit($id)
    {
        $data['categories'] = cat::select('id', 'name')->get();
        $data['trainers'] = trainer::select('id', 'name')->get();
        $data['course'] = course::findOrFail($id);
        return View('admin.courses.edit')->with($data);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:50',
            'small_desc' => 'required|string|max:191',
            'desc' => 'required|string',
            'cat_id' => 'required|exists:categories,id',
            'trainer_id' => 'required|exists:trainers,id',
            'img' => 'nullable|image|mimes:jpg,jpeg,png'
        ]);
        $old_name = course::findOrFail($request->id)->img;
        if ($request->hasFile('img')) {
            Storage::disk('uploads')->delete('Courses/'.$old_name);
            $new_name_image = $data['img']->hashName();
            Image::make($data['img'])->resize(970, 520)->save(public_path('Uploads/Courses/'.$new_name_image));
            $data['img'] = $new_name_image;
        } else {
            $data['img'] = $old_name;
        }
        course::findOrFail($request->id)->update($data);
        return redirect(route('admin.courses.index'));
    }

    public function delete($id)
    {
        $old_name = course::findOrFail($id)->img;
        Storage::disk('uploads')->delete('Courses/'.$old_name);
        course::findOrFail($id)->delete();

        return redirect(route('admin.courses.index'));
    }
}
