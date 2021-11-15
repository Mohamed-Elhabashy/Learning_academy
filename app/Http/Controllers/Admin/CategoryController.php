<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::select('id', 'name')->orderBy('id', 'DESC')->get();

        return View('admin.categories.index', ['categories' => $categories]);
    }

    public function create()
    {
        return View('admin.categories.create');
    }

    public function store(StoreCategoryRequest $request)
    {
        Category::create($request->all());

        return redirect()->route('admin.categories.index');
    }

    public function edit(Category $category)
    {
        return View('admin.categories.edit', ['category' => $category]);
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->all());

        return redirect()->route('admin.categories.index');
    }

    public function delete(Category $category)
    {
        $category->delete();

        return back();
    }
}
