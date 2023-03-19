<?php

use App\Http\Controllers\Website\CategoryController;
use App\Http\Controllers\Website\HomePageController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;


Route::get('/', HomePageController::class);    //__invoke
/*
    Route::get('/', function () {
        $categories = Category::get();
        return view('website.home', compact('categories'));
    });
*/


Route::get('/category/{id}',[CategoryController::class, 'show']);
/*
    Route::get('/category', function(){
        return view('website.category');
    });
*/

Route::get('/product', function(){
    return view('website.product');
});
