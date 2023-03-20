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
}
