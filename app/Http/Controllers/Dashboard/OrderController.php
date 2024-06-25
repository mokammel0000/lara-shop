<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = $orders = Order::with(['user', 'products'])->withcount('products');

        if(request()->order_status) {
            $orders = $orders->where('status', request()->order_status);
        }
        if(request()->payment_method) {
            $orders = $orders->where('payment_method', request()->payment_method);
        }
        if(request()->order_date) {
            $orders = $orders->whereDate('created_at', request()->order_date);
        }

        $orders = $orders->latest()->paginate(10);

        request()->flash();
        // to cache the fields that're in the form in the session, it enables you to use them in the old() method...
        // these fields can't be cached unless 2 cases:
        // 1- There is an erorr(then they will cached automatically)
        // 2- You cached it to be sended.


        return view('dashboard.orders.index', compact('orders'));
        // return redirect()->withInput();
    }

}
