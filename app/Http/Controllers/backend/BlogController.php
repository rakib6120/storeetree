<?php

namespace App\Http\Controllers\backend;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use App\Helpers\Helper;

class BlogController extends BaseController
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
        $blogs = Blog::where('id', '>', 0);

        if ($request->get('title')) {
            $blogs = $blogs->where('title', "LIKE", "%" . $request->get('title') . "%");
        }

        if($request->has('status')) {
            if ($request->get('status') <> 2) {
                $blogs = $blogs->where('status', $request->get('status'));
            }
        }
        
        $blogs = $blogs->sortable(['sort' => 'ASC'])->paginate(50);
        return view('backend.blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('backend.blogs.create');
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
                Rule::unique('blogs', 'title')->whereNull('deleted_at'),
            ],
            'subtitle' => 'required',
            'description' => 'required',
            'sort' => 'sometimes|nullable|integer',
            'thumbnail' => 'sometimes|nullable|image',
        ];


        $messages = [
//            'title.required' => 'Title is required',
        ];

        $this->validate($request, $rules, $messages);

        $input = $request->all();
        $input['admin_id'] = Auth::guard('admin')->user()->id;
        if ($request->file('thumbnail')) {
            $thumbnail = Helper::uploadFile($request->file('thumbnail'), null, Config::get('constants.BLOG_THUMBNAIL'));
            $input['thumbnail'] = $thumbnail;
        }
        if (!$request->get('sort')) {
            $input['sort'] = Blog::max('id') + 1;
        }
        Blog::create($input);
        Session::flash('success', 'The Blog has been created');

        return redirect()->route('admin.blogs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $blog = Blog::find($id);
        return view('backend.blogs.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $blog = Blog::find($id);
        return view('backend.blogs.edit', compact('blog'));
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
                Rule::unique('blogs', 'title')->whereNull('deleted_at')->ignore($id),
            ],
            'subtitle' => 'required',
            'description' => 'required',
            'sort' => 'sometimes|nullable|integer',
            'thumbnail' => 'sometimes|nullable|image',
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

        if ($request->file('thumbnail')) {
            $thumbnail = Helper::uploadFile($request->file('thumbnail'), null, Config::get('constants.BLOG_THUMBNAIL'));
            $input['thumbnail'] = $thumbnail;
        }

        $blog = Blog::find($id);
        if (!$request->get('sort')) {
            $input['sort'] = $blog->sort;
        }
        $blog->update($input);
        Session::flash('success', 'The Blog has been updated');

        return redirect()->route('admin.blogs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $blog = Blog::find($id);
        $blog->update([
            'admin_id' => Auth::guard('admin')->user()->id
        ]);
        $blog->delete();
        Session::flash('success', 'The Blog has been deleted');
        return redirect()->back();
    }
    
}
