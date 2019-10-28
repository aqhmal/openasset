<?php

namespace App\Http\Controllers;

use Session;
use App\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show settings form.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $theme_colors = [
            ['black-light', 'White'],
            ['blue-light', 'Blue - White'],
            ['green-light', 'Green - White'],
            ['purple-light', 'Purple - White'],
            ['red-light', 'Red - White'],
            ['yellow-light', 'Yellow - White'],
            ['black',  'White - Black'],
            ['blue', 'Blue - Black'],
            ['green', 'Green - Black'],
            ['purple', 'Purple - Black'],
            ['red', 'Red - Black'],
            ['yellow', 'Yellow - Black']
        ];
        $theme = Setting::where('option', 'theme')->first();
        $backup = Setting::where('option', 'backup')->first();
        $user_enabled = Setting::where('option', 'user_enabled')->first();
        return view('setting.index', compact('backup', 'theme', 'theme_colors', 'user_enabled'));
    }

    /**
     * Update setting.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $backup = Setting::where('option', 'backup')->first();
            $backup->update([
                'value' => $request->backup
            ]);
            $theme = Setting::where('option', 'theme')->first();
            $theme->update([
                'value' => $request->theme
            ]);
            $user_enabled = Setting::where('option', 'user_enabled')->first();
            if($request->user_enabled === 'disabled') {
                $user_enabled->update([
                    'value' => 'false'
                ]);
            } else {
                $user_enabled->update([
                    'value' => 'true'
                ]);
            }
            Session::flash('message', 'Successfully saved changes.');
        } catch(QueryException $e) {
            Session::flash('error', 'Error : ' . $e->errorInfo[1]);
        }
        return redirect()->back();
    }
}
