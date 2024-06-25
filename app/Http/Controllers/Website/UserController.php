<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Profile Controllers
    public function getProfile()
    {
        $user = auth()->user();
        return view('website.user.profile', compact('user'));
    }

    public function postProfile()
    {
        request()->validate([
            'name' => 'required',
            'email' => [
                'required',
                // 'unique:users',
                Rule::unique('users')->ignore(auth()->id()),
            ],
            'phone' => 'numeric',
        ]);

        $user = auth()->user()->update(request()->all());

        if($user) {
            return back()->with('success', 'profile has been updated succesfully');
        }
        return back()->with('error', 'Error happened, please try again');
    }
    //---------------------------


    // Change Password Controllers
    public function getchangePassword()
    {
        return view('website.user.change_password');
    }

    public function postchangePassword()
    {
        request()->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed',
            // 'password_confirmation' => 'required',  // DON'T NEED TO WRITE IT
        ]);

        $user = auth()->user()->update(request()->all());

        if($user) {
            return back()->with('success', 'Password has been updated succesfully');
        }
        return back()->with('error', 'Error happened, please try again');
    }
    //----------------------------


    // Order Controllers
    public function getOrders()
    {
        $orders = auth()->user()->orders;

        $orders->load('products');

        return view('website.user.orders', compact('orders'));

    }

    public function cancelOrder()
    {
        // dd(request()->all());
        $updates = [
            'status' => 5,
        ];

        $order = Order::find(request()->order_id);
        $order->update($updates);

        return back();
    }


    //----------------------------
}
