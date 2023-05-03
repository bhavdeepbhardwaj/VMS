<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    // protected $redirectTo = '/customer/home';

    public function redirectTo()
    {
        if (Auth()->user()->role == 1) {
            return redirect()->route('admin.home');
        } else if (Auth()->user()->role == 2) {
            return redirect()->route('user.list');
        } else if (Auth()->user()->role == 0) {
            return redirect()->route('demo.index');
        } else {
            return redirect()->route('login')->with('error', 'Either Email or Password is wrong');
        }
    }



    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // public function showLoginForm()
    // {
    //     return view('auth.login');
    // }

    public function showLoginForm()
    {
        return view('welcome');
    }


    public function login(Request $request)
    {
        $input = $request->all();

        // $this->validate($request, [
        //     'email' => 'required|email',
        //     'password' => 'required',
        // ]);

        if (auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))) {

            // if (Hash::check(Auth::user()->password, Auth::user()->password)) {
            //     // default_password stored in plain text
            //     // The passwords match...
            // }

            if (Auth()->user()->role == 1) {
                return redirect()->route('admin.home');
            } else if (Auth()->user()->role == 2) {
                if (is_null(Auth()->user()->approve)) {
                    return redirect()->route('profile');
                    // return redirect()->route('thankYou.user');
                    // and laravel will then handle the redirect
                }
                return redirect()->route('user.list');
            } else if (Auth()->user()->role == 0) {
                return redirect()->route('demo.index');
            } else {
                return redirect()->route('login')->with('error', 'Either Email or Password is wrong');
            }
        }
        return redirect()->route('login')->with('error', 'Either Email or Password is wrong');
    }
}
