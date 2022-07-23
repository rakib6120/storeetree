<?php

namespace App\Http\Controllers\backend;

use App\Models\User;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends BaseController
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
        $users = User::where('id', '>', 0);

        if ($request->get('first_name')) {
            $users = $users->where('first_name', "LIKE", "%" . $request->get('first_name') . "%");
        }

        if ($request->get('last_name')) {
            $users = $users->where('last_name', "LIKE", "%" . $request->get('last_name') . "%");
        }

        if ($request->get('email')) {
            $users = $users->where('email', "LIKE", "%" . $request->get('email') . "%");
        }

        if ($request->get('from')) {
            $users = $users->whereDate('created_at', '>=',  $request->get('from'));
        }

        if ($request->get('to')) {
            $users = $users->whereDate('created_at', '<=',  $request->get('to'));
        }

        if ($request->get('country_id')) {
            $users = $users->whereDate('country_id', $request->get('country_id'));
        }

        if($request->has('status')) {
            if ($request->get('status') <> 2) {
                $users = $users->where('status', $request->get('status'));
            }
        }
        
        $users = $users->with('country')->sortable(['id' => 'DESC'])->paginate(50);
        $countries = Country::orderBy('title', 'ASC')->pluck('title', 'id')->all();
        return view('backend.users.index', compact('users', 'countries'));
    }    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activate($id) {
        $user = User::find($id);
        $user->update([
            'status' => 1,
            'admin_id' => Auth::guard('admin')->user()->id,
        ]);
        Session::flash('success', 'The User has been activated');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deactivate($id) {
        $user = User::find($id);
        $user->update([
            'status' => 0,
            'admin_id' => Auth::guard('admin')->user()->id,
        ]);
        Session::flash('success', 'The User has been deactvated');
        return redirect()->back();
    }
}
