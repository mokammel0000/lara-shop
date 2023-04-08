<?php

use App\Http\Controllers\Website\AuthController;
use App\Http\Controllers\Website\CartController;
use App\Http\Controllers\Website\CategoryController;
use App\Http\Controllers\Website\HomePageController;
use App\Http\Controllers\Website\ProductController;
use Illuminate\Support\Facades\Route;


Route::get('/', HomePageController::class);    //__invoke


Route::get('/category/{id}',[CategoryController::class, 'show']);
/*
    Route::get('/category/{id}', function(){
        return view('website.category');
    });
*/

Route::get('/product/{id}', [ProductController::class, 'show']);



Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'postRegister']);

Route::get('/login', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'postlogin']);

Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/cart', [CartController::class, 'index']);
Route::post('/add-to-cart',[CartController::class, 'addToCart']);