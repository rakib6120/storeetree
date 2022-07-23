<?php

namespace App\Http\Controllers\backend;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class CategoryController extends BaseController
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
        $categories = Category::where('id', '>', 0);
        
        $categories = $categories->sortable(['sort' => 'ASC'])->paginate(50);
        return view('backend.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('backend.categories.create');
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
                Rule::unique('categories', 'title')->whereNull('deleted_at'),
            ],
        ];


        $messages = [
//            'title.required' => 'Title is required',
        ];

        $this->validate($request, $rules, $messages);

        $input = $request->all();
        $input['admin_id'] = Auth::guard('admin')->user()->id;
        if (!$request->get('sort')) {
            $input['sort'] = Category::max('id') + 1;
        }
        Category::create($input);
        Session::flash('success', 'The Category has been created');

        return redirect()->route('admin.categories.index');
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
        $category = Category::find($id);
        return view('backend.categories.edit', compact('category'));
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
                Rule::unique('categories', 'title')->whereNull('deleted_at')->ignore($id),
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
        $category = Category::find($id);
        if (!$request->get('sort')) {
            $input['sort'] = $category->sort;
        }
        $category->update($input);
        Session::flash('success', 'The Category has been updated');

        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $category = Category::find($id);
        $category->update([
            'admin_id' => Auth::guard('admin')->user()->id
        ]);
        $category->delete();
        Session::flash('success', 'The Category has been deleted');
        return redirect()->back();
    }
    
}
