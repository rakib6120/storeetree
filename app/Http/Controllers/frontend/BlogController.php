<?php

namespace App\Http\Controllers\frontend;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends BaseController
{
    public function __construct() {
        parent::__construct();
    }
    /**
     * Display the blogs page of the site
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $blogs = Blog::where('status', 1);

        if($request->get('sort')) {
            if($request->get('sort') == 1) {
                $blogs = $blogs->orderBy('sort', 'ASC');
            } elseif($request->get('sort') == 2) {
                $blogs = $blogs->orderBy('id', 'DESC');
            }
        }
        $blogs = $blogs->with('admin')->get();
        
        return view('frontend.blogs.index', compact('blogs'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $blog = Blog::where([['status', 1], ['id', $id]])->firstOrFail();
        $blog->increment('views');
        $populars = Blog::where('status', 1)->orderBy('sort', 'ASC')->with('admin')->take(6)->get();
        $recents = Blog::where('status', 1)->orderBy('id', 'DESC')->with('admin')->take(6)->get();
        return view('frontend.blogs.show', compact('blog', 'recents', 'populars'));
    }

}
