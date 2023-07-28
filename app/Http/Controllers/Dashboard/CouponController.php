<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CouponController extends Controller
{

    public function index()
    {
        $coupons = Coupon::paginate(10);
        return view('dashboard.coupons.index', compact('coupons'));
    }


    public function create()
    {
        return view('dashboard.coupons.create');
    }


    public function store()
    {
        // dd(request()->all());
        request()->validate([
            'code' => 'required|unique:coupons,code', 
            'type' => 'required', 
            'discount' => 'required', 
            'redeems' => 'required', 
        ]);

        Coupon::create(request()->all());

        return back()->with('success', 'The coupon has been added succesfully');
    }


    public function show(string $id)
    {
        //
    }


    public function edit(Coupon $coupon)
    {
        return view('dashboard.coupons.edit', compact('coupon'));
    }


    public function update(Request $request, string $id)
    {
        request()->validate([
            'code' => [
                'required',
                Rule::unique('coupons')->ignore($id),
            ], 
            'type' => 'required', 
            'discount' => 'required', 
            'redeems' => 'required', 
        ]);

        $coupon = Coupon::find($id);
        $coupon->update(request()->all());

        return back()->with('success', 'The coupon has been added succesfully');
    }


    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return back();
    }

    public function toggleActive($id)
    {
        $coupon = Coupon::find($id);
        $coupon->update([
            'active' => !$coupon->active
        ]);
        return back();
    }
}
