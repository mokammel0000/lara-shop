<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Order;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Isset_;

use function PHPUnit\Framework\isNull;

class OrderController extends Controller
{
    public function checkout()
    {
        return view('website.checkout');
    }

    public function store()
    {

        if(is_null(request()->address)) {
            if(is_null(auth()->user()->address)) {
                request()->validate(['address' => 'required']);
            }
        }

        // $cartProducts = auth()->user()->cart;
        // dd($cartProducts);

        $cartProducts = auth()->user()->cart->products;
        // dd($cartProducts);


        $subTotal = 0;
        $prodcuts = [];

        foreach($cartProducts as $product) {
            $product->increment('sales');
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

        $orderData = [
            'user_id' => auth()->user()->id,
            // 'user_id' => auth()->id(),
            'payment_method' => request()->payment_method,
            'address' => request()->address ?? auth()->user()->address,
            'notes' => request()->notes,
            'subtotal' => $subTotal,
            'vat' => $vat,
            'total' => $total,
        ];

        // CHECK IF USER USE A COUPON---- THESE STEPS CAN BE IGNORED IN TRADITIONAL CHECKOUTS...
        // if(isset(session('coupon'))){
        if(session('coupon')) {
            $coupon = Coupon::where('code', session('coupon'))->first();

            $total -= session('coupon_discount');
            $orderData['total'] = $total;

            $orderData['coupon_id'] = $coupon->id;
        }


        // CREATE A NEW ORDER USING ORDER MODEL
        $newOrder = Order::create($orderData);

        // CREATE A NEW ORDER USING USER MODEL & ORDER RELATIONSHIP
        // here you havn't to send user_id, it will automatically add the authenticated user's id
        // $newOrder = auth()->user()->orders()->create($orderData);


        if($newOrder) {
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

    public function applyCoupon()
    {
        $coupon = Coupon::where('code', request()->code)->first();

        if(is_Null($coupon)) {
            return redirect('/cart')->with('coupon_error', 'This Coupon code is not found, please try again');
        }
        if(! $coupon->active) {
            return redirect('/cart')->with('coupon_error', 'This Coupon code has been expired');
        }

        if($coupon->type == Coupon::TYPE_FIXED) {
            $amout_of_discount = $coupon->discount;
        } elseif ($coupon->type == Coupon::TYPE_PERCENT) {
            $amout_of_discount = $coupon->discount * request()->total / 100;
        }

        session()->put('coupon', request()->code);
        session()->put('coupon_discount', $amout_of_discount);

        return redirect('/cart?code='. request()->code .'&discount='.$amout_of_discount);
    }
}
