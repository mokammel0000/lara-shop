<?php

use App\Http\Controllers\Website\AuthController;
use App\Http\Controllers\Website\UserController;
use App\Http\Controllers\Website\CartController;
use App\Http\Controllers\Website\CategoryController;
use App\Http\Controllers\Website\HomePageController;
use App\Http\Controllers\Website\OrderController;
use App\Http\Controllers\Website\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePageController::class);    //__invoke

/*
    Route::get('/category/{id}', function(){
        return view('website.category');
    });
*/
Route::get('/category/{id}',[CategoryController::class, 'show']);

Route::get('/product/{id}', [ProductController::class, 'show']);
Route::post('/product/review', [ProductController::class, 'review']);

Route::get('/search-results', [ProductController::class, 'search']);

Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'postRegister']);

Route::get('/login', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'postlogin']);

Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/profile', [UserController::class, 'getProfile']);
Route::post('/profile', [UserController::class, 'postProfile']);

Route::get('/orders', [UserController::class, 'getOrders']);
Route::post('/cancel-order', [UserController::class, 'cancelOrder']);

Route::get('/change-password', [UserController::class, 'getchangePassword']);
Route::post('/change-password', [UserController::class, 'postchangePassword']);

Route::get('/cart', [CartController::class, 'index']);
Route::post('/add-to-cart',[CartController::class, 'addToCart']);
Route::post('/update-cart',[CartController::class, 'update']);
Route::get('/remove-from-cart/{prodcutID}',[CartController::class, 'removeFromCart']);

Route::post('/apply-coupon', [OrderController::class, 'applyCoupon']);
Route::get('/checkout', [OrderController::class, 'checkout']);
Route::get('/complete-order', [OrderController::class, 'completedOrder']);
Route::post('/create-order', [OrderController::class, 'store']);




Route::get('/error-404',function() {
    return view('website.Error404');
});