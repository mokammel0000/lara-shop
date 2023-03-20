<?php

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