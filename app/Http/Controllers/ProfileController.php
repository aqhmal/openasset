<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\User;
use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin,user');
    }

    /**
     * Show profile form.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::guard('admin')->check()) {
            $user = Admin::find(Auth::user()->id);
        } else if(Auth::guard('user')->check()) {
            $user = User::find(Auth::user()->id);
        }
        return view('user.profile', compact('user'));
    }

    /**
     * Update user information.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'name' => 'required|string'
            ]);
            if(Auth::guard('admin')->check()) {
                $user = Admin::find(Auth::user()->id);
            } else if(Auth::guard('user')->check()) {
                $user = User::find(Auth::user()->id);
            }
            if($request->filled('password')) {
                if($request->hasFile('image')) {
                    $request->validate([
                        'image' => 'required|mimes:jpeg,png,jpg',
                        'password' => 'required|string|confirmed'
                    ]);
                    $user->update([
                        'email' => $request->email,
                        'name' => $request->name,
                        'image' => base64_encode(file_get_contents($request->image->path())),
                        'password' => Hash::make($request->password)
                    ]);
                } else {
                    $request->validate([
                        'password' => 'required|string|confirmed'
                    ]);
                    $user->update([
                        'email' => $request->email,
                        'name' => $request->name,
                        'password' => Hash::make($request->password)
                    ]);
                }
            } else {
                if($request->hasFile('image')) {
                    $request->validate([
                        'image' => 'required|mimes:jpeg,png,jpg'
                    ]);
                    $user->update([
                        'email' => $request->email,
                        'name' => $request->name,
                        'image' => base64_encode(file_get_contents($request->image->path()))
                    ]);
                } else {
                    $user->update([
                        'email' => $request->email,
                        'name' => $request->name
                    ]);
                }
            }
            Session::flash('success', 'Successfully updated profile.');
        } catch(QueryException $e) {
            if($e->errorInfo[1] == 1062) {
                Session::flash('error', 'The email already taken.');
            }
        }
        return redirect()->back();
    }
}
