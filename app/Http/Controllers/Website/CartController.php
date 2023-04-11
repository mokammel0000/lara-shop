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
        $isProductExist = false;   // suppose that, the product is not exist in the cart, it's new...

        // dd(auth()->user()->cart->products);

        // auth()->user()->cart->products()->create($productInfo);
        // creating a new product can't be done in this way,
        // because the relation between product and cart is many to many relation...
        // you need to use ATTACH() method to add each attribute in it's correct table...

        $product = auth()->user()->cart->products()->where('id', $request->product_id)->first();
        
        if($product){

            $isProductExist = true;
            // If the $product = NOT Null, then there is a product in the authenticated user's cart,
            // then just UPDATE it's quantity....

            $oldQuantity = $product->pivot->quantity;
            $newQuantity = $oldQuantity + $request['quantity'];
            
            auth()->user()
            ->cart
            ->products()
            ->updateExistingPivot(
                $request['product_id'], 
                ['quantity'=> $newQuantity]
            );


        } else {
            // If the $product = Null, then the prodcut isn't exist at user's cart, 
            // so, you have to add it to the user's cart...

            auth()->user()
            ->cart
            ->products()
            ->attach(
                $request['product_id'], 
                ['quantity'=> $request['quantity']]
            );
        }
        // add a product in the cart that is belongs to the user who sign in now....
        // so we need the relation between the user and his cart, 
        // also we need a relation between the cart and it's products. 


        // SINGLE VALUE RESPONSE...
        // return 'Product has been added to the cart';    

        // API RESPONSE...
        $resp = [
            'exists' => $isProductExist, 
            'message' => 'Product has been added to the cart',
        ];

        return response()->json($resp);
        
    }

    public function removeFromCart($productID)
    {
        // To remove any product from DB, u need 2 things
        // 1- cart ID: which u can fetch it here from the authenticated user's ID
        // 2- product ID: which is send from Ajax


        // auth()->user()->cart->products()->drop($productInfo);
        // delete a product can't be done in this way,
        // because the relation between product and cart is many to many relation...
        // you need to use DETACH() method to DELETE each attribute from it's correct table...

        auth()->user()->cart->products()->detach($productID);

        // delete a product from the cart that is belongs to the user who sign in now....
        // so we need the relation between the user and his cart, 
        // also we need a relation between the cart and it's products. 

        return 'Product has been deleted from your cart'; 

    }

    public function update(Request $request) 
    {
        // dd($request->all());
        // dd($request->except('_token'));
        // dd($request->only('quantity'));
        // dd($request->quantity);

        $newQuantities = [];

        foreach($request->quantity as $pid => $q){
            if($q == 0){
                auth()->user()->cart->products()->detach($pid);
                continue;
            }
            $newQuantities[$pid] = ['quantity' => $q];
        }

        // $newQuantities [10] = ['quantity' => 100];

        auth()->user()->cart->products()->sync($newQuantities);

        return back();

    }

}
