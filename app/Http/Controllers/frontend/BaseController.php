<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use App\Models\Country;
use App\Models\Setting;

class BaseController extends Controller
{    
    /**
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function __construct() {

        $countries = Cache::remember('countries', 22 * 60, function() {
            return Country::orderBy('title', 'ASC')->get();
        });
        View::share('countries', $countries);
        
        $settings = Cache::remember('settings', 22 * 60, function() {
            return Setting::first();
        });
        View::share('settings', $settings);

        $this->middleware(function($request, $next) {

            $authuser = Auth::user();
            
            View::share('authuser', $authuser);
            return $next($request);
        });
    }

}
