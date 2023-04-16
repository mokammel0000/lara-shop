<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function checkout()
    {
        return view('website.checkout');
    }

    public function store()
    {
        // dd(request()->all());    // HELPER METHOD

        // $cart = auth()->user()->cart;
        // dd($cart);

        $cart = auth()->user()->cart->products;
        // dd($cart);

        
        $subTotal = 0;
        $prodcuts = [];

        foreach($cart as $product){
            $productTotal = $product->price * $product->pivot->quantity;
            $subTotal += $productTotal;

            $prodcuts[ $product->id] = [
                'quantity' => $product->pivot->quantity, 
                'price' => $product->price, 
                'total' => $productTotal
            ];
        }
        // dd($prodcuts);
        $vat = $subTotal * (14 / 100);
        $total = $subTotal + $vat;
        // IN THE CART WE DID THIS CALCULATIONS IN THE BLADE, THAT WASN'T EFFECIENT,
        // YOU HAVE THE 2 WAYS NOW, YOU CAN USE WHAT BUSNISS REQUIRED...

        // CREATE A NEW ORDER USING ORDER MODEL
        $newOrder = Order::create([
            'user_id' => auth()->user()->id,
            // 'user_id' => auth()->id(),
            'payment_method' => request()->payment_method,
            'address' => request()->address,
            'notes' => request()->notes,
            'subtotal' => $subTotal,
            'vat' => $vat,
            'total' => $total,
        ]);
                       
        // CREATE A NEW ORDER USING USER MODEL & ORDER RELATIONSHIP
        // here you havn't to send user_id, it will automatically add the authenticated user's id
        // $newOrder = auth()->user()->orders()->create([
        //     'payment_method' => request()->payment_method,
        //     'address' => request()->address,
        //     'notes' => request()->notes,
        //     'subtotal' => $subTotal,
        //     'vat' => $vat,
        //     'total' => $total,
        // ]);


        if($newOrder){
            $newOrder->products()->sync($prodcuts);
                      // THIS IS THE PRODUCTS RELATION THAT'S IN ORDER MODEL
            auth()->user()->cart->products()->detach();     // TO EMPTY CART
                                                // if u send an id to the detach() it will remove the spesific product
                                                // if u don't it will empty the all products... 
        }

        return redirect('/complete-order');
    }

    public function completedOrder()
    {
        return view('website.complete_order');
    }
}
