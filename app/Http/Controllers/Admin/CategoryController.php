<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryStoreRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
 
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index',compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(CategoryStoreRequest $request)
    {   

        $image = $request->file('image')->store('public/categories');

        Category::create([
           'name'=>$request->name,
           'description'=>$request->description,
           'image'=>$image

        ]);
        return to_route('admin.categories.index')->with('success','Category created successfully');
    }


    public function show($id)
    {
        //
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit',compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
           'name'=>['required'],
           'description'=>['required'],
           ]);
           $image = $category->image;
          if ($request->hasFile('image')) {
              Storage::delete($category->image);
              $image = $request->file('image')->store('public/categories');
          }


           $category->update([
             'name'=>$request->name,
             'description'=>$request->description,
             'image'=>$image
           ]);
           return to_route('admin.categories.index')->with('success','Category updated successfully');
       
    }

    public function destroy(Category $category)
    {
        Storage::delete($category->image);
        $category->menus()->detach();
        $category->delete();

        return to_route('admin.categories.index')->with('danger','Category deleted successfully');
    }
}
