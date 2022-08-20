<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Support\Facades\Auth;

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

    public function previewStory() {
        $user = Auth::user()->load('stories');
        return view('frontend.preview-story', ['stories' => $user->stories]);
    }

}
