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
        $rules = [
            'first_name'    => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'email'        => [
                'required',
                'email',
                'max:255',
                Rule::unique('users'),
            ],
            'password'     => 'required|min:6|confirmed',
            'country_id'   => 'required',
            'postal_code'  => 'required',
            'dob'  => 'required',
            'connected_period' => 'required',
            //'terms' => 'required',
        ];


        $messages = [
//            'title.required' => 'Title is required',
        ];

        $this->validate($request, $rules, $messages);
        $input = $request->all();
        $input['password'] = bcrypt($request->get('password'));
        $input['dob'] = Carbon::createFromFormat('m-d-Y', $request->get('dob'))->format('Y-m-d');
        $input['status'] = 1;

        $user = User::create($input);
        
        FamilyTree::create([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'dob' => $input['dob'],
            'connect_with' => $request->get('connected_period'),
            'user_id' => $user->id,
            'gender' => 'male',
            'relation_id' => 13,
        ]);
        
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
