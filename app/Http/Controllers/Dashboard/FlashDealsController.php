<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\FlashDeal;
use App\Models\product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FlashDealsController extends Controller
{
    public function index()
    {
        $flash_deals = FlashDeal::with('product')->paginate(10);
        return view('dashboard.Flash_deals.index', compact('flash_deals'));
    }

    public function create()
    {
        $products = product::get();
        return view('dashboard.Flash_deals.create', compact('products')); 
    }

    public function store()
    {
        request()->validate([
            'title' => 'required',
            'discount_percentage'  => 'required|numeric|lt:100', 
            'duration'  => 'required|numeric',
            'start_at'  => 'required|after:now',
            'product_id' => 'required',
        ]);
        
        $inputs = request()->all();

        $product = product::with('photos')->find(request()->product_id);

        $inputs['original_price'] = round($product->price, 0);
        $inputs['discounted_price'] = round($inputs['original_price'] - ($product->price * $inputs['discount_percentage'] / 100), 0);

        $startDate = Carbon::parse($inputs['start_at']);
        $inputs['start_at'] = $startDate;
        
        $endDate = $startDate->addHours($inputs['duration']);
        $inputs['end_at'] = $endDate;

        $inputs['photo_path'] = $product->photos->first()->path ?? 'uploads/Products/image-placeholder-base.png';

        $newflashdeal = FlashDeal::create($inputs);
        
        return back()->with('success', 'Flash deal has been created succesfully');
    }

    public function show()
    {
        //
    }

    public function edit(FlashDeal $flash_deal)
    {
        $flash_deal->load('product');
        $products = product::get();
        return view('dashboard.Flash_deals.edit', compact('flash_deal', 'products'));
    }

    public function update(FlashDeal $flash_deal)
    {
        request()->validate([
            'title' => 'required',
            'discount_percentage' => 'required|numeric|lt:100',
            'duration' => 'required|numeric',
            'start_at' => 'required|after:now',
            'product_id' => 'required',
        ]);
        
        $inputs = request()->all();
        
        $product = Product::find(request()->product_id);
        $original_price = round($product->price, 0);
        $current_price = round($original_price - ($original_price * request()->discount_percentage / 100), 0);        

        $inputs['original_price'] = $original_price;
        $inputs['discounted_price'] = $current_price;

        $startDate = Carbon::parse(request()->start_at);
        $inputs['start_at'] = $startDate->toDateTimeString();
        $inputs['end_at'] = $startDate->addhours(request()->duration)->toDateTimeString();
        
        
        $flash_deal->update($inputs);

        return back()->with('success', 'The Deal has been Edited Succesfully');
    }

    public function destroy($id)
    {
        // $flash_deal = FlashDeal::find($id);
        // $flash_deal->delete();

        FlashDeal::destroy($id);

        return back()->with('deleted', 'The Flash Deal has been deleted succesfully');

    }

    public function toggleActive($id)
    {
        $flash_deal = FlashDeal::with('product')->find($id);
        
        $cityTimezone = 'Egypt';
        $currentDateTime = Carbon::now($cityTimezone)->addhour()->toDateTimeString();

        if(!$flash_deal->active){
            if($flash_deal->start_at->lessThan($currentDateTime)){
                $flash_deal->start_at = $currentDateTime;
                $flash_deal->save();
            }
        }

        $original_price = round($flash_deal->product->price, 0);
        $current_price = round($original_price - ($original_price * $flash_deal->discount_percentage / 100), 0);

        // Don't do that until you write the active attribute in the fillable
        $flash_deal->update([
            'original_price' => $original_price, 
            'discounted_price' => $current_price,
            'active' => !$flash_deal->active,
        ]);

        return back();
    }
}
