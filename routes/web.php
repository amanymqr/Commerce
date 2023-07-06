<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
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

    });
});

Auth::routes(['verify'=> true]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::view('no-access','no_access');
// Route::view('not-allowed', 'not_allowed');


//site Routs
Route::get('/',function ()  {
    return 'home';
})->name('site.index');
