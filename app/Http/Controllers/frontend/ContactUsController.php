<?php

namespace App\Http\Controllers\frontend;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ContactUsController extends BaseController
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
        return view('frontend.contact');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'comments' => 'required',
        ];


        $messages = [
//            'title.required' => 'Title is required',
        ];

        $this->validate($request, $rules, $messages);

        $input = $request->all();

        if(auth()->user()) {
            $input['user_id'] = auth()->user()->id;
        }
        
        Contact::create($input);
        Session::flash('success', 'The Contact has been created');

        return redirect()->route('contact-us');
    }

}
