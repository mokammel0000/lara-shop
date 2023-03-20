<?php

namespace App\Providers;

use App\View\Composers\PopularProductsComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;



class ViewServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        //
    }


    public function boot(): void
    {
        View::composer(['website.partials.popular_products'] , PopularProductsComposer::class);
    }
}


