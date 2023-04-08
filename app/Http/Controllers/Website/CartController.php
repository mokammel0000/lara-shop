<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $products = auth()->user()->cart->products;
        return view('website.cart', compact('products'));
    }

    public function addToCart(Request $request)
    {
        // $productInfo = $request->only('_token');
        $productInfo = $request->except('_token');

        // dd(auth()->user()->cart->products);

        // auth()->user()->cart->products()->create($productInfo);
        // creating a new product can't be done in this way,
        // because the relation between product and cart is many to many relation...
        // you need to use ATTACH() and DEATTACH() methods...

        auth()->user()->cart->products()->attach(
            $productInfo['product_id'], 
            ['quantity'=> $productInfo['quantity']]
        );

        // add a product in the cart that is belongs to the user who sign in now....
        // so we need the relation between the user and his cart, 
        // also we need a relation between the cart and it's products. 

        return 'Product has been added to the cart';
        
    }
}
