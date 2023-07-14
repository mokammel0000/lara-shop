<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\SliderController;

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


Route::resource('/slides', SliderController::class);
    // MY OWN WAY
//Route::get('/slides/deactivate/{id}', [SliderController::class, 'deactivate']);
//Route::get('/slides/activate/{id}',[ SliderController::class, 'activate']);
    // ENG.MOHAMED ISMAIEL'S WAY
Route::get('/toggle-slide-active/{id}',[ SliderController::class, 'toggleActive']);
