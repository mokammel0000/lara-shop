<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\CategoryController;

Route::get('/', function () {
    return view('dashboard.index');
})->name('admin.index');

Route::get('/login', function () {
    return view('dashboard.login');
})->name('admin.login');

Route::resource('/categories', CategoryController::class);
//
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