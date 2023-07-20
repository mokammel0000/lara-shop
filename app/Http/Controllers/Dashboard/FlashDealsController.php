<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\FlashDeal;
use App\Models\product;
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
            'product_id' => 'required', 
            'name' => 'required', 
            'deal_percent' => 'required|numeric', 
            'duaration' => 'required|numeric', 

        ]);

        $inputs = request()->all();
        $product = product::with('photos')->find(request()->product_id);
        
        $inputs['photo_path'] = 
                        isset($product->photos->first()->path) ?
                                $product->photos->first()->path :
                                'uploads/Products/image-placeholder-base.png';

        $newflashdeal = FlashDeal::create($inputs);
        
        return back()->with('success', 'Flash deal has been created succesfully');
    }

    public function show()
    {
        //
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
        $flash_deal = FlashDeal::find($id);
        
        $flash_deal->active = !$flash_deal->active;
        $flash_deal->save();

        // Now, this can't be performed.
        // $flash_deal->update([
        //     'active' => !$flash_deal->active,
        // ]);

        return back();
    }
}
