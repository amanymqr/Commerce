<?php

namespace App\Http\Controllers\Admin;

use App\Models\Image;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::with('category')->orderByDesc('id')->paginate(5);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $product = new Product();
        return view('admin.products.create', compact('categories', 'product'));
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
            'content_en' => 'required',
            'content_ar' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'category_id' => 'required',
        ]);

        // Upload File
        $img_name = rand() . time() . $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('uploads/products'), $img_name);

        $name = json_encode([
            'en' => $request->name_en,
            'ar' => $request->name_ar,
        ], JSON_UNESCAPED_UNICODE);

        $content = json_encode([
            'en' => $request->content_en,
            'ar' => $request->content_ar,
        ], JSON_UNESCAPED_UNICODE);

        // Insert To Database
        $product = Product::create([
            'name' => $name,
            'image' => $img_name,
            'content' => $content,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'quantity' => $request->quantity,
            'category_id' => $request->category_id,
        ]);

        //upload Album to images if exist
        if ($request->has('album')) {
            foreach ($request->album as $item) {
                $img_name = rand() . time() . $item->getClientOriginalName();
                $item->move(public_path('uploads/products'), $img_name);
                Image::create([
                    'path' => $img_name,
                    'product_id' => $product->id,
                ]);
            }
        };
        // Redirect
        return redirect()->route('admin.products.index')->with('msg', 'Product created successfully')->with('type', 'success');
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
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('categories', 'product'));
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
            'image' => 'nullable',
            'content_en' => 'required',
            'content_ar' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'category_id' => 'required',
        ]);
        $product = Product::findOrFail($id);
        $img_name=$product->image;
        if($request->hasFile('image')){
            // Upload File
            $img_name = rand() . time() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads/products'), $img_name);

        }

        $name = json_encode([
            'en' => $request->name_en,
            'ar' => $request->name_ar,
        ], JSON_UNESCAPED_UNICODE);

        $content = json_encode([
            'en' => $request->content_en,
            'ar' => $request->content_ar,
        ], JSON_UNESCAPED_UNICODE);

        // Insert To Database
        $product->update([
            'name' => $name,
            'image' => $img_name,
            'content' => $content,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'quantity' => $request->quantity,
            'category_id' => $request->category_id,
        ]);

        //upload Album to images if exist
        if ($request->has('album')) {
            foreach ($request->album as $item) {
                $img_name = rand() . time() . $item->getClientOriginalName();
                $item->move(public_path('uploads/products'), $img_name);
                Image::create([
                    'path' => $img_name,
                    'product_id' => $product->id,
                ]);
            }
        };
        // Redirect
        return redirect()->route('admin.products.index')->with('msg', 'Product updated successfully')->with('type', 'info');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        File::delete(public_path('uploads/products/' . $product->image));
        $product->album()->delete();
        $product->delete();
        return redirect()->route('admin.products.index')->with('msg', 'Product deleted successfully')->with('type', 'danger');
    }
    public function delete_image($id)
    {
        Image::destroy($id);
        return redirect()->back();
    }
}
