<?php

namespace App\Http\Controllers\frontend;

use App\Models\Warmup;
use App\Helpers\Helper;
use App\Models\Category;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CreateStoryController extends BaseController
{
    public function __construct() {
        parent::__construct();
    }

    /**
     * Display the about-us page of the site
     *
     * @return \Illuminate\Http\Response
     */
    public function step1() {
        return view('frontend.story.step1');
    }

    /**
     * Display the about-us page of the site
     *
     * @return \Illuminate\Http\Response
     */
    public function show() {
        return view('frontend.story.show');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function step1Store(Request $request) {

        $rules = [
            'plan' => 'required',
        ];


        $messages = [
//            'title.required' => 'Title is required',
        ];

        $this->validate($request, $rules, $messages);

        $cart = Session::get('cart');

        $cart['plan'] = $request->get('plan');
        Session::put('cart', $cart);

        return redirect()->route('create-your-story.step-2');
    }

    
    /**
     * Display the about-us page of the site
     *
     * @return \Illuminate\Http\Response
     */
    public function step2() {
        $cart = Session::get('cart');
        if(!$cart) return redirect()->route('create-your-story.step-1');
        $categories = Category::where('status', 1)->with('questions')->get();
        return view('frontend.story.step2', compact('categories', 'cart'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function step2Store(Request $request) {

        $rules = [
            'questions' => 'array|min:1',
        ];


        $messages = [
//            'title.required' => 'Title is required',
        ];

        $this->validate($request, $rules, $messages);

        $cart = Session::get('cart');

        $cart['questions'] = $request->get('questions');
        Session::put('cart', $cart);

        return redirect()->route('create-your-story.step-3');
    }

    
    /**
     * Display the about-us page of the site
     *
     * @return \Illuminate\Http\Response
     */
    public function step3() {
        $cart = Session::get('cart');
        if(!$cart) return redirect()->route('create-your-story.step-1');
        $warmups = Warmup::where('status', 1)->get();
        return view('frontend.story.step3', compact('warmups', 'cart'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function step3Store(Request $request) {

        $rules = [
            'warmups' => 'array|min:1',
        ];


        $messages = [
            // 'title.required' => 'Title is required',
        ];

        $this->validate($request, $rules, $messages);

        $cart = Session::get('cart');

        $cart['warmups'] = $request->get('warmups');
        Session::put('cart', $cart);

        $authuser = auth()->user();

        if($authuser) {
            return redirect()->route('create-your-story.step-4');
        }
        
        Session::put('redirect', route('create-your-story.step-4'));

        return redirect()->route('create-your-story.step-3', ['login' => 1]);
        
    }

    /**
     * Display the about-us page of the site
     *
     * @return \Illuminate\Http\Response
     */
    public function step4() {
        $cart = Session::get('cart');
        if(!$cart) return redirect()->route('create-your-story.step-1');
        $questions = Question::whereIn('id', $cart['questions'])->orderBy('sort', 'ASC')->get();

        $storyItems         = collect(Session::get('storyItems'));
        $currentQuestion    = [];
        $current            = false;
        $totalStoryUploaded = 0;

        foreach($questions as $key => $question) {
            if($storyItems) {
                if(in_array($question->id, $storyItems->pluck('question_id')->toArray())) {
                    $question->class = 'qs_complete';
                    $totalStoryUploaded++;
                }
            }

            if(!$current) {
                if(!$question->class) {
                    $question->class    = 'qs_qurrent';
                    $currentQuestion    = $question;
                    $current            = true;
                    $totalStoryUploaded = 0;
                }
            }
        }

        if (count($questions) === $totalStoryUploaded) {
            return redirect()->route('create-your-story.step-4.show', $questions[0]->id);
        }

        return view('frontend.story.step4', compact('cart', 'questions', 'currentQuestion', 'storyItems'));
    }
    public function step4Preview($id) {
        $cart = Session::get('cart');
        if(!$cart) return redirect()->route('create-your-story.step-1');
        $questions = Question::whereIn('id', $cart['questions'])->orderBy('sort', 'ASC')->get();
        $storyItems = collect(Session::get('storyItems'));

        if (!$storyItems->where('question_id', $id)->count()) {
            abort(404);    
        }

        $currentQuestion = [];
        $current         = false;

        foreach($questions as $key=>$question) {
            if($storyItems) {
                if(in_array($question->id, $storyItems->pluck('question_id')->toArray())) {
                    $question->class = 'qs_complete';
                }
            }

            if(!$current) {
                if($question->id == $id) {
                    $question->class = 'qs_complete qs_qurrent';
                    $question->video = $storyItems->where('question_id', $id)->first()['video'];
                    $currentQuestion = $question;
                    $current = true;
                }
            }
        }
        
        return view('frontend.story.step4', compact('cart', 'questions', 'currentQuestion', 'storyItems'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function step5(Request $request) {
        $cart       = Session::get('cart');
        if(!$cart) return redirect()->route('create-your-story.step-1');
        
        $questions  = Question::whereIn('id', $cart['questions'])->orderBy('sort', 'ASC')->get();
        $storyItems = collect(Session::get('storyItems'));

        // Cheking is all cart story was uploaded or redirect to upload.
        if (array_diff($cart['questions'], $storyItems->pluck('question_id')->toArray())) {
            return redirect()->route('create-your-story.step-4');
        }

        // Checking if any extra story uploaded then remove them.
        $extraStory = array_diff($storyItems->pluck('question_id')->toArray(), $cart['questions']);
        if ($extraStory) {
            Helper::bulkMediaDelete($storyItems->whereIn('question_id', $extraStory)->toArray());
            $storyItems = collect(Session::get('storyItems'));
        }

        return view('frontend.story.step5', compact('questions', 'storyItems'));
    }

}
