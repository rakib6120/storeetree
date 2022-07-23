<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Support\Facades\Auth;
use App\Models\Blog;
use App\Models\Faq;
use App\Models\Setting;

class HomeController extends BaseController
{
    public function __construct() {
        parent::__construct();
    }
    /**
     * Display the home page of the site
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $blogs = Blog::where('status', 1)->orderBy('sort', 'ASC')->take(10)->get();
        $faqs = Faq::where('status', 1)->orderBy('sort', 'ASC')->take(5)->get();
        return view('frontend.home', compact('blogs', 'faqs'));
    }

    public function command() {
        shell_exec( 'cd '. base_path() .' && composer update' );

        dd('Test');
    }

}
