<?php
 
namespace App\View\Composers;

use App\Models\product;
use Illuminate\View\View;
 
class WebsiteHeaderComposer
{
    protected $cartCount;

    public function __construct()
    {
        $this->cartCount = auth()->check()? auth()->user()->cart->products->count(): 0 ;
    }

    public function compose(View $view)
    {
        $view->with('cartCount', $this->cartCount);
    }
}