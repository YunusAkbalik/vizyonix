<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductImageController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
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

Route::post('login', [AuthController::class, 'login'])->middleware('guest')->name('login_post');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');


Route::get('login', function () {return view('admin.auth.index');})->middleware('guest')->name('admin_login');
Route::middleware(['auth','role:admin'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('admin_dashboard');
    Route::prefix('product')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('admin_product_index');
        Route::get('create', [ProductController::class, 'create'])->name('admin_product_create');
        Route::post('store', [ProductController::class, 'store'])->name('admin_product_store');
        Route::post('image_delete', [ProductImageController::class, 'destroy'])->name('admin_product_delete_image');
        Route::post('update', [ProductController::class, 'update'])->name('admin_product_update');
        Route::post('destroy', [ProductController::class, 'destroy'])->name('admin_product_destroy');
        Route::get('/{id}', [ProductController::class, 'edit'])->name('admin_product_edit');
    });
    Route::prefix('category')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('admin_category_index');
        Route::get('create', [CategoryController::class, 'create'])->name('admin_category_create');
        Route::post('store', [CategoryController::class, 'store'])->name('admin_category_store');
        Route::post('update', [CategoryController::class, 'update'])->name('admin_category_update');
        Route::post('destroy', [CategoryController::class, 'destroy'])->name('admin_category_destroy');
        Route::get('/{id}', [CategoryController::class, 'edit'])->name('admin_category_edit');
    });
    Route::prefix('order')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('admin_order_index');
        Route::post('updateStatus', [OrderController::class, 'updateStatus'])->name('admin_order_updateStatus');
        Route::get('/{id}', [OrderController::class, 'show'])->name('admin_order_show');
    });
    Route::prefix('coupon')->group(function () {
        Route::get('/', [CouponController::class, 'index'])->name('admin_coupon_index');
        Route::get('create', [CouponController::class, 'create'])->name('admin_coupon_create');
        Route::post('update', [CouponController::class, 'update'])->name('admin_coupon_update');
        Route::post('store', [CouponController::class, 'store'])->name('admin_coupon_store');
        Route::get('/{id}', [CouponController::class, 'edit'])->name('admin_coupon_edit');
    });
    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('admin_user_index');
    });
});
