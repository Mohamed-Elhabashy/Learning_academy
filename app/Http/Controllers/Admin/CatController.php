<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\cat;
use Illuminate\Http\Request;

class CatController extends Controller
{
    public function index()
    {
        $data['cats'] = cat::select('id', 'name')->orderBy('id', 'DESC')->get();
        return View('Admin.cats.index')->with($data);
    }

    public function create()
    {
        return View('Admin.cats.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:20'
        ]);
        cat::create($data);
        return redirect(route('admin.cats.index'));
    }

    public function edit($id)
    {
        $data['cat'] = cat::findOrFail($id);
        return View('Admin.cats.edit')->with($data);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:20'
        ]);
        cat::findOrFail($request->id)->update($data);
        return redirect(route('admin.cats.index'));
    }

    public function delete($id)
    {
        cat::findOrFail($id)->delete();
        return redirect(route('admin.cats.index'));
    }
}
