<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\FamilyTree;
use DB;
use Session;
use Carbon\Carbon;

class ProfileController extends BaseController
{
    public function __construct() {
        parent::__construct();
    }
    /**
     * Display the about-us page of the site
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('frontend.profile');
    }

    public function previewStory() {
        $user = Auth::user()->load('stories');
        return view('frontend.preview-story', ['stories' => $user->stories]);
    }

    public function updateProfile (Request $request)
    {

        DB::beginTransaction();
        $authuser=Auth::user();
        // dd($authuser->id);
        $rules = [
            'first_name'    => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'country_id'   => 'required',
            'postal_code'  => 'required',
            'dob'  => 'required',
            'connected_period' => 'required',
            'gender' => 'required',
            //'terms' => 'required',
        ];


        $messages = [
           'gender.required' => 'Gender is required',
        ];

        $this->validate($request, $rules, $messages);

        // dd($request->all());

        $input=[];
        // $input = $request->all();
        // $input['password'] = bcrypt($request->get('password'));
        $input['dob'] =date_format(date_create( $request->get('dob')),'Y-m-d'); //Carbon::createFromFormat('m-d-Y', $request->get('dob'))->format('Y-m-d');
        $input['status'] = 1;
        $input['gender'] = $request->gender;
        $input['updated_at'] = Carbon::now();

        // dd($input);

        // $user = User::where('id',$authuser->id)->update($input);
        $user = User::find($authuser->id);


        $user->first_name=$request->first_name;
        $user->last_name=$request->last_name;
        $user->country_id=$request->country_id;
        $user->postal_code=$request->postal_code;
        $user->dob=$request->dob;
        $user->connected_period=$request->connected_period;
        $user->gender=$request->gender;


        // $familyTree=FamilyTree::where('user_id',$authuser->id)->update(
        //             [
        //                 'first_name' => $request->first_name,
        //                 'last_name' => $request->last_name,
        //                 'dob' => $request->dob,
        //                 'connect_with' => $request->connected_period,
        //                 // 'user_id' => $authuser->id,
        //                 'gender' => $request->gender,
        //                 'relation_id' => 13,
        //                 'updated_at' => Carbon::now(),
        //             ]
        //         );

        $familyTree=FamilyTree::where('user_id',$authuser->id)->first();

        $familyTree->first_name=$request->first_name;
        $familyTree->last_name=$request->last_name;
        $familyTree->dob=$request->dob;
        $familyTree->connect_with=$request->connected_period;
        $familyTree->gender=$request->gender;
        $familyTree->updated_at=Carbon::now();
        
        // dd($familyTree);
        if( $user->save() && $familyTree->save()){
            DB::commit();
            Session::flash("errMsg","Profile Updated Successfully.");
        }
        else{
            DB::rollBack();
            Session::flash('errMsg',"Failed To Update Profile.Plase Try Again.");
        }

        return redirect()->back();
    }

}
