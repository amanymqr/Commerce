<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index(){
        $product_slider = Product::orderByDesc('id')->take(3)->get();
        $categories     = Category::orderByDesc('id')->take(3)->get();
        $product_latest = Product::orderByDesc('id')->take(9)->offset(3)->get();
        return view('site.index' , compact('product_slider' ,'categories','product_latest'));
    }
}
