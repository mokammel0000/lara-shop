<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\CouponController;
use App\Http\Controllers\Dashboard\FlashDealsController;
use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\SliderController;
use App\Http\Controllers\Dashboard\UserController;

Route::get('/', function () {
    return view('dashboard.index');
})->name('admin.index');


Route::get('/login', function () {
    return view('dashboard.login');
})->name('admin.login');


/*
    Route::get('/categories', [CategoryController::class, 'index']);
    //Route::get('/categories', ['App\Http\Controllers\Dashboard\CategoryController', 'index']);
    Route::get('/categories/show', [CategoryController::class, 'show']);

    Route::get('/categories/create', [CategoryController::class, 'create']);
    Route::post('/categories/store', [CategoryController::class, 'store']);

    Route::get('/categories/edit', [CategoryController::class, 'edit']);
    Route::post('/categories/update', [CategoryController::class, 'update']);

    Route::get('/categories/destroy', [CategoryController::class, 'destroy']);
*/
Route::resource('/categories', CategoryController::class);

Route::resource('/products', ProductController::class);
Route::get('/products/del-img/{id}', [ProductController::class, 'delImage']);

Route::resource('flash-deals', FlashDealsController::class);
Route::get('/toggle-deal-active/{id}', [FlashDealsController::class, 'toggleActive']);

Route::resource('/slides', SliderController::class);
Route::get('/toggle-slide-active/{id}',[ SliderController::class, 'toggleActive']);
    // MY OWN WAY
//Route::get('/slides/deactivate/{id}', [SliderController::class, 'deactivate']);
//Route::get('/slides/activate/{id}',[ SliderController::class, 'activate']);
    // ENG.MOHAMED ISMAIEL'S WAY

Route::resource('/customers', UserController::class);

Route::resource('/orders', OrderController::class);
Route::get('/orders/change-status', [OrderController::class, 'changeStatus']);

Route::resource('/coupons', CouponController::class);
Route::get('/toggle-coupon-active/{id}', [CouponController::class, 'toggleActive']);