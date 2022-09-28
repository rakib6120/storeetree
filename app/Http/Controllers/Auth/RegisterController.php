<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\FamilyTree;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class RegisterController extends Controller
{
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    
    /**
     * Handle a registration request for the application and sent mail to user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $user=User::where('email',strtolower(trim($request->email)))->first();

        if(empty($user)) {
            $rules = [
                'first_name'    => 'required|string|max:255',
                'last_name'     => 'required|string|max:255',
                'email'        => [
                    'required',
                    'email',
                    'max:255',
                    Rule::unique('users'),
                ],
                // 'email'=>'required|email',
                'password'     => 'required|min:6|confirmed',
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
            
            $input = $request->all();
            $input['password'] = bcrypt($request->get('password'));
            $input['dob'] =date_format(date_create( $request->get('dob')),'Y-m-d'); //Carbon::createFromFormat('m-d-Y', $request->get('dob'))->format('Y-m-d');
            $input['status'] = 1;
            $input['verified'] = 1;
            $input['gender'] = strtolower($request->gender);

            // dd($input);

            $user = User::create($input);


            
            $relativeInfo=new FamilyTree();

            $relativeInfo->first_name=$request->first_name;

            $relativeInfo->last_name=$request->last_name;

            $relativeInfo->email=strtolower(trim($request->email));

            $relativeInfo->gender=strtolower($request->gender);

            $relativeInfo->user_id=$user->id;

            $relativeInfo->dob=date_format(date_create( $request->get('dob')),'Y-m-d');

            $relativeInfo->status=1;

            $relativeInfo->created_at=Carbon::now();

            $relativeInfo->save();

             // dd($user);
            
            auth()->loginUsingId($user->id);

            return response()->json(
                [
                    'status' => 'success',
                    'user'   => $user,
                    'redirect' => Session::get('redirect') ? Session::get('redirect') : route('profile'),
                ]
            );
        }
        else{

            if($user->verified!=1){
                $rules = [
                        'first_name'    => 'required|string|max:255',
                        'last_name'     => 'required|string|max:255',
                        // 'email'        => [
                        //     'required',
                        //     'email',
                        //     'max:255',
                        //     Rule::unique('users'),
                        // ],
                        'email'=>'required|email',
                        'password'     => 'required|min:6|confirmed',
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
        
        $input = $request->all();
        $input['password'] = bcrypt($request->get('password'));
        $input['dob'] =date_format(date_create( $request->get('dob')),'Y-m-d'); //Carbon::createFromFormat('m-d-Y', $request->get('dob'))->format('Y-m-d');
        $input['status'] = 1;
        $input['verified'] = 1;
        $input['gender'] = strtolower($request->gender);

        // dd($input);

        $user = User::update($input);
        
        $relativeInfo=FamilyTree::where('user_id',$user->id)->first();

        $relativeInfo->first_name=$request->first_name;

        $relativeInfo->last_name=$request->last_name;

        $relativeInfo->email=strtolower(trim($request->relation_email));

        $relativeInfo->gender=strtolower($request->gender);

        $relativeInfo->user_id=$user->id;

        $relativeInfo->dob=date_format(date_create( $request->get('dob')),'Y-m-d');

        $relativeInfo->status=1;

        $relativeInfo->created_at=Carbon::now();

        $flag=$relativeInfo->save();
        
        auth()->loginUsingId($user->id);

        return response()->json(
            [
                'status' => 'success',
                'user'   => $user,
                'redirect' => Session::get('redirect') ? Session::get('redirect') : route('profile'),
            ]
        );
            }
        }
    }
}
