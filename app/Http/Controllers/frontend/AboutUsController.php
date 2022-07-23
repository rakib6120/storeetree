<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Support\Facades\Auth;
use App\Models\Blog;

class AboutUsController extends BaseController
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
        $blogs = Blog::where('status', 1)->orderBy('sort', 'ASC')->take(10)->get();
        return view('frontend.about-us', compact('blogs'));
    }

}
