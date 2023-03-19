<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($id)
    {
        // $category = Category::with('products')->find($id);
        // using the last query we can't paginate the selected records...

        $category = Category::find($id);
        
                                        //in DB       //field 
        // $products = product::where('category_id' , $category->id)->paginate(10);
        $products = product::where('category_id' , $id)->paginate(10);
        
        $start = ($products->currentPage() - 1) * $products->perPage();
 
        return view('website.category', compact('products', 'category', 'start'));
    }
}