<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $customers = User::where('type', 1)->with('orders')->paginate(10);
        return view('dashboard.customers.index', compact('customers'));
    }
}
