<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{    
    /**
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function __construct() {
        $this->middleware(function($request, $next) {

            $authuser = Auth::guard('admin')->user();
            
            View::share('authuser', $authuser);
            return $next($request);
        });
    }

}
