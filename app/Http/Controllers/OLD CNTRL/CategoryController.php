<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
   
    public function index()
    {
       
        $categories = Category::orderBy('name')->paginate(20);

        return view('admin.categories.index', compact('categories'));
    }

   
    public function create()
    {
        return view('admin.categories.create');
    }

    
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        
        Category::create([
            'name' => $request->input('name'),
        ]);

      
        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'crated with success');
    }

   
    public function edit(Category $category)
    {
       
        return view('admin.categories.edit', compact('category'));
    }

   
    public function update(Request $request, Category $category)
    {
        
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' ,
        ]);

     
        $category->name = $request->input('name');
        $category->save();

        
        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'updated with success ');
    }

   
    public function delete(Category $category)
    {
        
        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'deleted with success');
    }
}
