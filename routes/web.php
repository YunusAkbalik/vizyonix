<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[HomeController::class , 'index']);

Route::prefix('product')->group(function () {
    Route::get('/',[ProductController::class , 'index'])->name('admin_product_index');
    Route::get('create',[ProductController::class , 'create'])->name('admin_product_create');
    Route::post('store',[ProductController::class , 'store'])->name('admin_product_store');
});

Route::prefix('category')->group(function () {
    Route::get('/',[CategoryController::class , 'index'])->name('admin_category_index');
    Route::get('create',[CategoryController::class , 'create'])->name('admin_category_create');
    Route::post('store',[CategoryController::class , 'store'])->name('admin_category_store');
    Route::get('/{id}',[CategoryController::class , 'edit'])->name('admin_category_edit');
    Route::post('update',[CategoryController::class , 'update'])->name('admin_category_update');
});
