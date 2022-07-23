<?php

namespace App\Http\Controllers\frontend;

use App\Models\Faq;

class FaqController extends BaseController
{
    public function __construct() {
        parent::__construct();
    }
    /**
     * Display the faqs page of the site
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $faqs = Faq::where('status', 1)->orderBy('sort', 'ASC')->get();
        return view('frontend.faqs', compact('faqs'));
    }

}
