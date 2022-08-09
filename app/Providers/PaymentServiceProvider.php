<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['frontend.story.step5', 'frontend.payment'], function ($view){
            $cart  = Session::get('cart');
            $plans = [
                1 => ['title' => "Lite Package", 'price' => 19.99], 
                2 => ['title' => "Standard Package", 'price' => 29.99], 
                3 => ['title' => "Premimum Package", 'price' => 49.99], 
            ];

            return $view->with('packagePlan', $plans[$cart['plan']]);
        });
    }
}
