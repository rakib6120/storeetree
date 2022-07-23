<?php

namespace App\Http\Controllers\backend;

use App\Models\Category;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class QuestionController extends BaseController
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
        $questions = Question::where('id', '>', 0);
        
        $questions = $questions->with('category')->sortable(['sort' => 'ASC'])->paginate(50);
        return view('backend.questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $categories = Category::where('status', 1)->orderBy('sort', 'ASC')->get()->pluck('title', 'id')->all();
        return view('backend.questions.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $rules = [
            'category_id' => 'required',
            'title' => [
                'required',
                Rule::unique('questions', 'title')->where('category_id', $request->get('category_id'))->whereNull('deleted_at'),
            ],
        ];


        $messages = [
//            'title.required' => 'Title is required',
        ];

        $this->validate($request, $rules, $messages);

        $input = $request->all();
        $input['admin_id'] = Auth::guard('admin')->user()->id;
        if (!$request->get('sort')) {
            $input['sort'] = Question::where('category_id', $request->get('category_id'))->max('id') + 1;
        }
        Question::create($input);
        Session::flash('success', 'The Question has been created');

        return redirect()->route('admin.questions.index');
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
        $question = Question::find($id);
        $categories = Category::where('status', 1)->orderBy('sort', 'ASC')->get()->pluck('title', 'id')->all();
        return view('backend.questions.edit', compact('question', 'categories'));
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
            'category_id' => 'required',
            'title' => [
                'required',
                Rule::unique('questions', 'title')->where('category_id', $request->get('category_id'))->whereNull('deleted_at')->ignore($id),
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
        $question = Question::find($id);
        if (!$request->get('sort')) {
            $input['sort'] = $question->sort;
        }
        $question->update($input);
        Session::flash('success', 'The Question has been updated');

        return redirect()->route('admin.questions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $question = Question::find($id);
        $question->update([
            'admin_id' => Auth::guard('admin')->user()->id
        ]);
        $question->delete();
        Session::flash('success', 'The Question has been deleted');
        return redirect()->back();
    }
    
}
