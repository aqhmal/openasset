<?php

namespace App\Http\Controllers;

use App\User;
use App\Asset;
use App\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $categories = Category::all();
        $assets = Asset::all();
        return view('dashboard.index', compact('users', 'categories', 'assets'));
    }
}
