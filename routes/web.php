<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\CategoryController;

Route::prefix('admin')->
name('admin.')
// ->middleware(['auth','is_admin'])->
->group(function()
{
    Route::get('/',[AdminController::class,'index'])->name('index');
    Route::resource('categories',CategoryController::class);
    Route::resource('product',ProductController::class);

});

Route::get('categories', [CategoryController::class, 'index'])->name('home');

Route::get('/',function(){
    return 'Good Jop';
})->name('web.index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
