<?php

namespace App\Http\Controllers\backend;

use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class FaqController extends BaseController
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
        $faqs = Faq::where('id', '>', 0);
        
        $faqs = $faqs->sortable(['sort' => 'ASC'])->paginate(50);
        return view('backend.faqs.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('backend.faqs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $rules = [
            'title' => [
                'required',
                Rule::unique('faqs', 'title')->whereNull('deleted_at'),
            ],
            'description' => 'required',
            'sort' => 'sometimes|nullable|integer',
        ];


        $messages = [
//            'title.required' => 'Title is required',
        ];

        $this->validate($request, $rules, $messages);

        $input = $request->all();
        $input['admin_id'] = Auth::guard('admin')->user()->id;
        if (!$request->get('sort')) {
            $input['sort'] = Faq::max('id') + 1;
        }
        Faq::create($input);
        Session::flash('success', 'The Faq has been created');

        return redirect()->route('admin.faqs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $faq = Faq::find($id);
        return view('backend.faqs.show', compact('faq'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $faq = Faq::find($id);
        return view('backend.faqs.edit', compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $rules = [
            'title' => [
                'required',
                Rule::unique('faqs', 'title')->whereNull('deleted_at')->ignore($id),
            ],
            'description' => 'required',
            'sort' => 'sometimes|nullable|integer',
        ];

        $messages = [
//            'title.required' => 'Title is required',
        ];

        $this->validate($request, $rules, $messages);

        $input = $request->all();
        $input['admin_id'] = Auth::guard('admin')->user()->id;
        if (!$request->has('status')) {
            $input['status'] = 0;
        }

        $faq = Faq::find($id);
        if (!$request->get('sort')) {
            $input['sort'] = $faq->sort;
        }
        $faq->update($input);
        Session::flash('success', 'The Faq has been updated');

        return redirect()->route('admin.faqs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $faq = Faq::find($id);
        $faq->update([
            'admin_id' => Auth::guard('admin')->user()->id
        ]);
        $faq->delete();
        Session::flash('success', 'The Faq has been deleted');
        return redirect()->back();
    }
    
}
