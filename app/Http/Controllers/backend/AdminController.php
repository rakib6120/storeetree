<?php

namespace App\Http\Controllers\backend;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class AdminController extends BaseController
{
    public function __construct() {
        parent::__construct();
    }

    public function dashboard() {
        return view('backend.admin');
    }

    public function password() {
        return view('backend.admins.changePassword');
    }

    public function passwordUpdate(Request $request) {
        $messages = [
            'old_password.required' => 'Current password is required',
            'old_password.old_password' => 'Current password is wrong',
            'password.required' => 'New Password is required',
            'password.confirmed' => 'New Passwords does not match',
            'password.min' => 'New Password must be at least 6 char long',
            'password.max' => 'New Password can be maximum 200 char long',
        ];

        $this->validate($request, [
            'old_password' => 'required|old_password:' . Auth::guard('admin')->user()->password,
            'password' => 'required|confirmed|min:6|max:255',
                ], $messages);

        $user = Auth::guard('admin')->user();

        $user['password'] = bcrypt($request->get('password'));

        $user->save();

        Session::flash('success', 'Your password has been updated');

        return redirect()->route('admin.editPassword');
    }

    public function index() {
        $adminusers = Admin::orderBy('created_at', 'DESC')->paginate(20);

        return view('backend.admins.index', compact('adminusers'));
    }

    public function create() {
        return view('backend.admins.create');
    }

    public function store(Request $request) {
        $messages = [
            'name.required' => 'Name field is required',
            'email.required' => 'Email field is required',
            'email.unique' => 'Email already exists',
            'password.required' => 'Password field is required',
            'password_confirmation.required' => 'Confirm Password field is required',
        ];

        $this->validate($request, [
            'name' => 'required',
            'email' => [
                'required',
                Rule::unique('admins', 'email')->whereNull('deleted_at'),
                'email'
            ],
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
                ], $messages);

        $input = $request->all();

        unset($input['password_confirmation']);

        $input['password'] = bcrypt($request->get('password'));
        $input['admin_id'] = Auth::guard('admin')->user()->id;
        $admin = Admin::create($input);
        if ($request->get('access')) {
            $admin->accesses()->sync($request->get('access'));
        }
        Session::flash('success', 'Admin User has been created');

        return redirect()->route('admin.admins.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $admin = Admin::find($id);
        return view('backend.admins.edit', compact('admin'));
    }

    /**
     * Update a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $rules = [
            'name' => 'required',
            'email' => [
                'required',
                Rule::unique('admins', 'email')->whereNull('deleted_at')->ignore($id),
                'email'
            ],
        ];


        $messages = [
            'name.required' => 'Name field is required',
            'email.required' => 'Email field is required',
            'email.unique' => 'Email already exists',
        ];

        $this->validate($request, $rules, $messages);

        $input = $request->all();
        if (!$request->has('status')) {
            $input['status'] = 0;
        }
        $input['admin_id'] = Auth::guard('admin')->user()->id;

        $admin = Admin::find($id);
        $admin->update($input);

        if ($request->get('access')) {
            $admin->accesses()->sync($request->get('access'));
        } else {
            $admin->accesses()->sync([]);
        }

        Session::flash('success', 'The Admin has been updated');

        return redirect()->route('admin.admins.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        if (Auth::guard('admin')->user()->id == $id) {

            Session::flash('error', 'You cannot delete your own account');

            return redirect()->route('admin.admins.index');
        } else {
            $admin = Admin::find($id);

            $admin->update([
                'admin_id' => Auth::guard('admin')->user()->id
            ]);
            
            $admin->delete();

            Session::flash('success', 'The Admin has been deleted');

            return redirect()->route('admin.admins.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function resetPassword($id) {
        $admin = Admin::find($id);
        return view('backend.admins.resetPassword', compact('admin'));
    }

    public function resetPasswordStore($id, Request $request) {
        $messages = [
            'password.required' => 'Password field is required',
            'password_confirmation.required' => 'Confirm Password field is required',
        ];

        $this->validate($request, [
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
                ], $messages);

        $input = $request->only('password');
        $input['password'] = bcrypt($request->get('password'));
        $input['admin_id'] = Auth::guard('admin')->user()->id;
        $admin = Admin::find($id);
        $admin->update($input);

        Session::flash('success', 'Admin User password has been updated');
        return redirect()->route('admin.admins.index');
    }

}
