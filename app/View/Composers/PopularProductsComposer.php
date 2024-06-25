<?php

namespace App\View\Composers;

use App\Models\product;
use Illuminate\View\View;

class PopularProductsComposer
{
    protected $products;

    public function __construct()
    {
        // $this->products = product::orderBy('views', 'desc')->get();
        // get all products after ordering them...


        $this->products = product::orderBy('views', 'desc')->limit(10)->get();
        // get the top 10 products after ordering them...
    }



    public function compose(View $view): void
    {
        $view->with('products', $this->products);
    }
}
