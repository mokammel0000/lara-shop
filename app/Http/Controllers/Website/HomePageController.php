<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function __invoke(Request $request)
    {
        $categories = Category::get();
        return view('website.home', compact('categories'));
    }
}
