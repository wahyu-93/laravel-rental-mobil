<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate(10);

        return inertia('Admin/Categories/Index',[
            'categories' =>  $categories
        ]);  
    }

    public function create()
    {
        return inertia('Admin/Categories/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255'
        ]);

        Category::create($request->name);
        return redirect()->route('admin.categories.index');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return inertia('Admin/Category/Edit',[
            'category' => $category,
        ]);
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        
        $request->validate([
            'nama' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ]);

        $category->update($request->name);
        return redirect()->route('admin.categories.index');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        $category->delete();

        return redirect()->route('admin.categories.index');
    }

}
