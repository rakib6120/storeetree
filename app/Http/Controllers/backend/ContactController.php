<?php

namespace App\Http\Controllers\backend;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class ContactController extends BaseController
{
    public function __construct() {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $contacts = Contact::where('id', '>', 0);

        if ($request->get('name')) {
            $contacts = $contacts->where('name', "LIKE", "%" . $request->get('name') . "%");
        }

        if ($request->get('email')) {
            $contacts = $contacts->where('email', "LIKE", "%" . $request->get('email') . "%");
        }

        if ($request->get('phone')) {
            $contacts = $contacts->where('phone', "LIKE", "%" . $request->get('phone') . "%");
        }
        
        $contacts = $contacts->sortable(['id' => 'DESC'])->paginate(50);
        return view('backend.contacts.index', compact('contacts'));
    }
}
