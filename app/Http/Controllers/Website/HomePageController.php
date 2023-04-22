<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Slide;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function __invoke(Request $request)
    {
        $categories = Category::get();

        $slides = Slide::where('active', 1)->get();
        // $slides = Slide::where('active','!=',  0)->get();
        

        return view('website.home', compact('categories', 'slides'));
    }
}
