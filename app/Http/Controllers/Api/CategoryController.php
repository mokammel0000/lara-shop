<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        // return Category::get();     // This will retrive JSON File,
        //but the best is to convert it using laravel helper method...

        // return response()->json([
        //     'cats' => Category::get(), // sending ALL DATA, without any customization
        // ]);

        return response()->json([
            'cats' => CategoryResource::collection(Category::get()), // sending CUSTOMIZED DATA
        ]);
    }


    public function store(Request $request)
    {
        dd($request->all());
    }


    public function show(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
