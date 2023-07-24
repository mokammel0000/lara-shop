<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\FlashDeal;
use App\Models\product;
use App\Models\Slide;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function __invoke(Request $request)
    {
        $categories = Category::get();

        $slides = Slide::where('active', 1)->get();
        // $slides = Slide::where('active','!=',  0)->get();
        
        $products = product::with('photos')->orderBy('sales', 'desc')->limit(6)->get();

        $computers_products = product::with('photos')->where('category_id',1)->orderBy('sales', 'desc')->limit(6)->get();
        
        $laptops_products = product::with('photos')->where('category_id',2)->orderBy('sales', 'desc')->limit(6)->get();

        $flash_deals = FlashDeal::with('product')->where('active', '1')->get();

        return view('website.home', compact(
            'categories',
            'slides',
            'products',
            'computers_products',
            'laptops_products',
            'flash_deals'
        ));
    }
}
