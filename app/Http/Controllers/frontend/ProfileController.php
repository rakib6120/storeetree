<?php

namespace App\Http\Controllers\frontend;

class ProfileController extends BaseController
{
    public function __construct() {
        parent::__construct();
    }
    /**
     * Display the about-us page of the site
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('frontend.profile');
    }

}
