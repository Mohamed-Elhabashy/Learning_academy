<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class TrainerController extends Controller
{
    public function index()
    {
        $data['trainers'] = trainer::select('id', 'name', 'phone', 'spec', 'img')->orderBy('id', 'DESC')->get();
        return View('Admin.trainers.index')->with($data);
    }

    public function create()
    {
        return View('Admin.trainers.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:50',
            'spec' => 'required|string|max:50',
            'phone' => 'nullable|string|max:20',
            'img' => 'required|image|mimes:jpg,jpeg,png'
        ]);
        $new_name_image = $data['img']->hashName();
        Image::make($data['img'])->resize(50, 50)->save(public_path('Uploads/trainers/'.$new_name_image));
        $data['img'] = $new_name_image;
        trainer::create($data);
        return redirect(route('admin.trainer.index'));
    }

    public function edit($id)
    {
        $data['trainer'] = trainer::findOrFail($id);
        return View('Admin.trainers.edit')->with($data);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:50',
            'spec' => 'required|string|max:50',
            'phone' => 'nullable|string|max:20',
            'img' => 'nullable|image|mimes:jpg,jpeg,png'
        ]);
        $old_name = trainer::findOrFail($request->id)->img;
        if ($request->hasFile('img')) {
            Storage::disk('uploads')->delete('trainers/'.$old_name);
            $new_name_image = $data['img']->hashName();
            Image::make($data['img'])->resize(50, 50)->save(public_path('Uploads/trainers/'.$new_name_image));
            $data['img'] = $new_name_image;
        } else {
            $data['img'] = $old_name;
        }
        trainer::findOrFail($request->id)->update($data);
        return redirect(route('admin.trainer.index'));
    }

    public function delete($id)
    {
        $old_name = trainer::findOrFail($id)->img;
        Storage::disk('uploads')->delete('trainers/'.$old_name);
        trainer::findOrFail($id)->delete();

        return redirect(route('admin.trainer.index'));
    }
}
