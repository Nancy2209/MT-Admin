<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function redirectRoute()
    {
        $user = Auth::user();
        if ($user) {
            return redirect()->back();
        } else {
            return redirect()->route('admin.showlogin');
        }
    }

    public function doLogin(Request $request)
    {
        $rules = array(
            'email' => 'required|email',
            'password' => 'required'
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)
                ->withInput($request->except('password'));
        } else {
            $userdata = array(
                'email' => $request->email,
                'password' => $request->password,
            );

            if (Auth::attempt($userdata)) {
                return redirect()->route('admin.dashboard');
            } else {
                return Redirect::back()->withInput($request->except('password'))
                    ->withErrors(['Something went wrong!']);
            }
        }
    }

    public function showRegisterForm()
    {
        return view('admin.register');
    }

    public function doRegister(Request $request)
    {
        $rules = [
            'name' => 'required',
            'password' => 'required',
            'uid' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'profile_image' => 'mimes:jpeg,jpg,png,gif|max:2048',
            'organization_id' => 'required'
        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->except('password'));
        } else {
            unset($requestData['_token']);
            $requestData['password'] = bcrypt($request->password);
            $requestData['status'] = 1;
            $requestData['role_type'] = 'admin';
            if ($request->file('profile_image')) {
                //            profile image upload
                $profileImage = $request->file('profile_image');
                $profileName = time() . 'profile.' . $profileImage->getClientOriginalExtension();
                Storage::disk('public')->put($profileName,  File::get($profileImage));
                $requestData['profile_image'] = Storage::disk('public')->url($profileName);
            }
            $user = User::create($requestData);
            Auth::login($user);
            return redirect()->route('admin.dashboard');
        }
    }
}
