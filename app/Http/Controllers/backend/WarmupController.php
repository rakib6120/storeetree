<?php

namespace App\Http\Controllers\backend;

use App\Models\Warmup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class WarmupController extends BaseController
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
        $warmups = Warmup::where('id', '>', 0);
        
        $warmups = $warmups->sortable(['sort' => 'ASC'])->paginate(50);
        return view('backend.warmups.index', compact('warmups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('backend.warmups.create');
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
                Rule::unique('warmups', 'title')->whereNull('deleted_at'),
            ],
        ];


        $messages = [
//            'title.required' => 'Title is required',
        ];

        $this->validate($request, $rules, $messages);

        $input = $request->all();
        $input['admin_id'] = Auth::guard('admin')->user()->id;
        if (!$request->get('sort')) {
            $input['sort'] = Warmup::max('id') + 1;
        }
        Warmup::create($input);
        Session::flash('success', 'The Warmup has been created');

        return redirect()->route('admin.warmups.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $warmup = Warmup::find($id);
        return view('backend.warmups.edit', compact('warmup'));
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
                Rule::unique('warmups', 'title')->whereNull('deleted_at')->ignore($id),
            ],
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
        $warmup = Warmup::find($id);
        if (!$request->get('sort')) {
            $input['sort'] = $warmup->sort;
        }
        $warmup->update($input);
        Session::flash('success', 'The Warmup has been updated');

        return redirect()->route('admin.warmups.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $warmup = Warmup::find($id);
        $warmup->update([
            'admin_id' => Auth::guard('admin')->user()->id
        ]);
        $warmup->delete();
        Session::flash('success', 'The Warmup has been deleted');
        return redirect()->back();
    }
    
}
