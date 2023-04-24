<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($id){

        $product = product::with(['category', 'photos'])->find($id);

        // $product->views = $product->views += 1;
        // $product->save();

        $product->update(['views' => $product->views + 1]);
        
        // $product->increment('views');


        return view('website.product', compact('product'));
    }

    public function search(){

        /* YOU HAVE 3 CASES IN SEARCHIN:
        FIRST CASE: USER SEARCH USING KEYWORD
        SECOND CASE: USER SEARCH USING CATEGORY NAME
        THIRD CASE: USER SEARCH USING KEYWORD & CATEGORY NAME
        */
        $keyword = request()->keyword;
        $category_id = request()->category_id;
        
            // THIS IS A TIPYCALL SEARCH, IT'S NOT EFFECTIVE....
        // $products = product::where('name', '=', $keyword)
        //                     ->orWhere('description', '=', $keyword)
        //                     ->get();
        
            // THIS IS ALSO A TIPYCALL SEARCH, IT'S NOT EFFECTIVE.... YOU SHOULD ADD PLACEHOLDERS
        // $products = product::where('name', 'LIKE', $keyword)
        //                     ->orWhere('description', 'LIKE', $keyword)
        //                     ->get(); 

            // PLACEHOLDERS: 
            //                _ ----> one character
            //                % ----> one or more characters
        
        // $products = product::where('name', 'LIKE', '_'.$keyword.'___') // one char before it, and three chars after it
        //                     ->orWhere('description', 'LIKE', '_'.$keyword.'_')
        //                     ->get(); 

        // $products = Product::query()->dd();
        
        $products = product::query(); // equal SELECT * FROM PRODUCT
        if($keyword){
            $prodcuts = $products->where(function($q) use($keyword){
                // THIS IS A COMPOUND WHERE, ONE WHERE CONTAINS MULTIPLE CASES
                return $q->where('name', 'LIKE', "%$keyword%")
                            ->orWhere('description', 'LIKE', "%$keyword%")
                            ->orWhere('sku', '=', "$keyword")
                            ->orWhere('price', '=', "$keyword");
            });
        } 
        if($category_id){
            $products = $products->where('category_id', $category_id);
        }
        $products = $products->get(); 

        return view('website.search_results', compact('products'));
        // redirect('website.search_results')->withInputs('keyword');
    }
}
