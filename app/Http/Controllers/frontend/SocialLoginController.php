<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class SocialLoginController extends Controller
{
    protected $redirectTo = '/';
    
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
     * Redirect the user to the OAuth Provider.
     *
     * @return Response
     */
    public function redirectToProvider($provider, Request $request) {
        if ($request->get('redirect')) {
            Session::put('redirect', $request->get('redirect'));
        }
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from provider.  Check if the user already exists in our
     * database by looking up their provider_id in the database.
     * If the user exists, log them in. Otherwise, create a new user then log them in. After that 
     * redirect them to the authenticated users homepage.
     *
     * @return Response
     */
    public function handleProviderCallback($provider) {
        try {
            $user = Socialite::driver($provider)->user();

            $authUser = $this->authenticate($user, $provider);

            if($authUser->deletedAt) {
                Session::flash('error', 'Your account has been deactivated. Please contact with the system admin.');
                return redirect()->route('home');
            } else if($authUser->isActive()) {
                Auth::login($authUser, true);

                Session::put('socialLogin', $provider);
                
                if (Session::get('redirect')) {
                    $redirect = Session::get('redirect');
                    Session::forget(['redirect', 'customer']);
                    return redirect()->intended($redirect);
                } else {
                    return redirect($this->redirectTo);
                }
            } else {
                Session::flash('error', 'Your account has been deactivated. Please contact with the system admin.');
                return redirect()->route('home');
            }
        } catch (\Exception $e) {
            Session::flash('error', 'Something went wrong in social login. Please try again.');
            return redirect()->route('home');
        }
    }

    /**
     * If a user has registered before using social auth, return the user
     * else, create a new user object.
     * @param  $user Socialite user object
     * @param $provider Social auth provider
     * @return  User
     */
    public function authenticate($user, $provider) {
        $authUser = User::withTrashed()->where('email', $user->email)->first();

        if ($authUser) {
            return $authUser;
        }
        
        $name     = explode(' ', $user->name);
        $lastName = null;
        if(isset($name[1])) {
            $lastName = $name[1];
        }

        $authUser = User::create([
            'first_name'        => $name[0],
            'last_name'         => $lastName,
            'email'             => $user->email,
            'email_verified_at' => Carbon::now(),
            'status'            => 1,
        ]);
        return $authUser;
    }
    
}
