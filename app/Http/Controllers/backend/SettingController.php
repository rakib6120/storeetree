<?php

namespace App\Http\Controllers\backend;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cache;

class SettingController extends BaseController
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
        $settings = Setting::first();
        if($settings) {
            return view('backend.settings.edit', compact('settings'));
        }
        
        return view('backend.settings.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $rules = [
            'home_video' => 'required|file',
            'story_first_step' => 'required|file',
            'story_second_step' => 'required|file',
            'story_third_step' => 'required|file',
            'story_fourth_step' => 'required|file',
            'story_fifth_step' => 'required|file',
        ];


        $messages = [
//            'title.required' => 'Title is required',
        ];

        $this->validate($request, $rules, $messages);

        $input = $request->all();
        $input['admin_id'] = Auth::guard('admin')->user()->id;
        
        if ($request->file('home_video')) {
            $home_video = Helper::uploadFile($request->file('home_video'), null, Config::get('constants.HOME_PAGE_VIDEO'));
            $input['home_video'] = $home_video;
        }
        
        if ($request->file('story_first_step')) {
            $home_video = Helper::uploadFile($request->file('story_first_step'), null, Config::get('constants.HOME_PAGE_VIDEO'));
            $input['story_first_step'] = $home_video;
        }
        
        if ($request->file('story_second_step')) {
            $home_video = Helper::uploadFile($request->file('story_second_step'), null, Config::get('constants.HOME_PAGE_VIDEO'));
            $input['story_second_step'] = $home_video;
        }
        
        if ($request->file('story_third_step')) {
            $home_video = Helper::uploadFile($request->file('story_third_step'), null, Config::get('constants.HOME_PAGE_VIDEO'));
            $input['story_third_step'] = $home_video;
        }
        
        if ($request->file('story_fourth_step')) {
            $home_video = Helper::uploadFile($request->file('story_fourth_step'), null, Config::get('constants.HOME_PAGE_VIDEO'));
            $input['story_fourth_step'] = $home_video;
        }
        
        if ($request->file('story_fifth_step')) {
            $home_video = Helper::uploadFile($request->file('story_fifth_step'), null, Config::get('constants.HOME_PAGE_VIDEO'));
            $input['story_fifth_step'] = $home_video;
        }
        Setting::create($input);
        Cache::forget('settings');
        Session::flash('success', 'The Setting has been created');

        return redirect()->route('admin.settings.index');
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
        //
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
            'home_video' => 'sometimes|nullable|file',
            'story_first_step' => 'sometimes|nullable|file',
            'story_second_step' => 'sometimes|nullable|file',
            'story_third_step' => 'sometimes|nullable|file',
            'story_fourth_step' => 'sometimes|nullable|file',
            'story_fifth_step' => 'sometimes|nullable|file',
        ];

        $messages = [
//            'title.required' => 'Title is required',
        ];

        $this->validate($request, $rules, $messages);

        $input = $request->all();
        $input['admin_id'] = Auth::guard('admin')->user()->id;
        
        if ($request->file('home_video')) {
            $home_video = Helper::uploadFile($request->file('home_video'), null, Config::get('constants.HOME_PAGE_VIDEO'));
            $input['home_video'] = $home_video;
        }
        
        if ($request->file('story_first_step')) {
            $home_video = Helper::uploadFile($request->file('story_first_step'), null, Config::get('constants.HOME_PAGE_VIDEO'));
            $input['story_first_step'] = $home_video;
        }
        
        if ($request->file('story_second_step')) {
            $home_video = Helper::uploadFile($request->file('story_second_step'), null, Config::get('constants.HOME_PAGE_VIDEO'));
            $input['story_second_step'] = $home_video;
        }
        
        if ($request->file('story_third_step')) {
            $home_video = Helper::uploadFile($request->file('story_third_step'), null, Config::get('constants.HOME_PAGE_VIDEO'));
            $input['story_third_step'] = $home_video;
        }
        
        if ($request->file('story_fourth_step')) {
            $home_video = Helper::uploadFile($request->file('story_fourth_step'), null, Config::get('constants.HOME_PAGE_VIDEO'));
            $input['story_fourth_step'] = $home_video;
        }
        
        if ($request->file('story_fifth_step')) {
            $home_video = Helper::uploadFile($request->file('story_fifth_step'), null, Config::get('constants.HOME_PAGE_VIDEO'));
            $input['story_fifth_step'] = $home_video;
        }

        $settings = Setting::find($id);
        $settings->update($input);
        Cache::forget('settings');
        Session::flash('success', 'The Setting has been updated');

        return redirect()->route('admin.settings.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }
    
}
