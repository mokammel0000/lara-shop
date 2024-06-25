<?php

namespace App\View\Composers;

use App\Models\Category;
use App\Models\product;
use Illuminate\View\View;

class WebsiteHeaderComposer
{
    protected $cats;
    protected $cartCount;

    public function __construct()
    {
        $this->cats = Category::get() ;
        $this->cartCount = auth()->check() ? auth()->user()->cart->products->count() : 0 ;
    }

    public function compose(View $view)
    {
        $view->with('cats', $this->cats)
              ->with('cartCount', $this->cartCount);

    }
}
