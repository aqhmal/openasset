<?php

namespace App\Http\Controllers\Auth;

use Session;
use App\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Show login page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_enabled = Setting::where('option', 'user_enabled')->first()->value;
        return view('auth.login', compact('user_enabled'));
    }

    /**
     * Handle a login request to the application.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
            'group' => 'required|in:admin,user'
        ],[
            'group.in' => 'Please select admin or user.'
        ]);
        if(Auth::guard($request->group)->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended(route('dashboard'));
        }
        Session::flash('error', 'Email or Password is incorrect.');
        return redirect()->back()->withInput($request->except('password'));
    }
}
