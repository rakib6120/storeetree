<?php

namespace App\Http\Controllers\backend;

use App\Models\Relation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class RelationController extends BaseController
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
        $relations = Relation::where('id', '>', 0);
        
        $relations = $relations->sortable(['sort' => 'ASC'])->with('parent')->paginate(50);
        return view('backend.relations.index', compact('relations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $parents = Relation::orderBy('sort', 'ASC')->pluck('title', 'id')->all();
        return view('backend.relations.create', compact('parents'));
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
                Rule::unique('relations', 'title')->whereNull('deleted_at'),
            ],
            'gender' => 'required',
        ];


        $messages = [
//            'title.required' => 'Title is required',
        ];

        $this->validate($request, $rules, $messages);

        $input = $request->all();
        $input['admin_id'] = Auth::guard('admin')->user()->id;
        if (!$request->get('sort')) {
            $input['sort'] = Relation::max('id') + 1;
        }

        if (!$request->get('parent_id')) {
            $input['parent_id'] = NULL;
        }

        Relation::create($input);
        Session::flash('success', 'The Relation has been created');

        return redirect()->route('admin.relations.index');
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
        $relation = Relation::find($id);
        $parents = Relation::orderBy('sort', 'ASC')->pluck('title', 'id')->all();
        return view('backend.relations.edit', compact('relation', 'parents'));
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
                Rule::unique('relations', 'title')->whereNull('deleted_at')->ignore($id),
            ],
            'gender' => 'required',
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

        $relation = Relation::find($id);
        if (!$request->get('sort')) {
            $input['sort'] = $relation->sort;
        }
        
        if (!$request->get('parent_id')) {
            $input['parent_id'] = NULL;
        }

        $relation->update($input);
        Session::flash('success', 'The Relation has been updated');

        return redirect()->route('admin.relations.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $relation = Relation::find($id);
        $relation->update([
            'admin_id' => Auth::guard('admin')->user()->id
        ]);
        $relation->delete();
        Session::flash('success', 'The Relation has been deleted');
        return redirect()->back();
    }
    
}
