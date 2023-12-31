<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


//admin dashboard with authentiaction
Route::prefix(LaravelLocalization::setLocale())->group(function ()
{
    Route::prefix('admin')->name('admin.')->middleware('auth','user_type','verified')->group(function ()
    {
//  بيفحص هل مسجل دخول وكمان مش يوزر -أدمن
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::resource('categories',CategoryController::class);
    Route::resource('products',ProductController::class);
    Route::get('delete-image/{id}', [ProductController::class, 'delete_image'])->name('products.delete_image');
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::delete('users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    });

    Auth::routes(['verify'=> true]);
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::view('no-access','no_access');



    //Site Routs
    Route::get('/', [SiteController::class, 'index'])->name('site.index');
    Route::get('/about', [SiteController::class, 'about'])->name('site.about');
    Route::get('/shop', [SiteController::class, 'shop'])->name('site.shop');
    Route::get('/contact', [SiteController::class, 'contact'])->name('site.contact');
    // Route::get('/category', [SiteController::class, 'category'])->name('site.category');
    Route::get('/category/{id}', [SiteController::class, 'category'])->name('site.category');
    Route::get('/product/{id}', [SiteController::class, 'product'])->name('site.product');

});

