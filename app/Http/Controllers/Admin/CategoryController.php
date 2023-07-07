<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::orderByDesc('id')->paginate(10);
        return view('admin.Categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.Categories.create' , compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // Validate Data
        $request->validate([
            'name_en' => 'required',
            'name_ar' => 'required',
            'image' => 'required',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        // Upload File
        $img_name = rand() . time() . $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('uploads/categories'), $img_name);

        // convert name to json
        $name = json_encode([
            'en' => $request->name_en,
            'ar' => $request->name_ar,
        ], JSON_UNESCAPED_UNICODE);

        // Insert To Database
        Category::create([
            'name' => $name,
            'image' => $img_name,
            'parent_id' => $request->parent_id
        ]);

        // Redirect
        return redirect()->route('admin.categories.index')->with('msg', 'Category created successfully')->with('type', 'success');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $categories = Category::all();
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('categories', 'category'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
         // Validate Data
            $request->validate([
            'name_en' => 'required',
            'name_ar' => 'required',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $category = Category::findOrFail($id);

        // Upload File
        $img_name = $category->image;
        if($request->hasFile('image')) {
            $img_name = rand() . time() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads/categories'), $img_name);
        }

        // Insert To Database
        $category->update([
            'name' => $request->name_en . ' ' . $request->name_ar,
            'image' => $img_name,
            'parent_id' => $request->parent_id
        ]);

        // Redirect
        return redirect()->route('admin.categories.index')->with('msg', 'Category updated successfully')->with('type', 'info');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        File::delete(public_path('uploads/categories/'.$category->image));
        $category->childrens()->update(['parent_id' => null]);
        $category->delete();
        return redirect()->route('admin.categories.index')->with('msg', 'Category deleted successfully')->with('type', 'danger');

    }
}
