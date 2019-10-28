<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\User;
use App\Asset;
use App\Borrow;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Resources\AssetCollection;
use Illuminate\Database\QueryException;

class AssetController extends Controller
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
     * Display assets list and add asset form.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        if(Auth::guard('admin')->check()) {
            return view('asset.index', compact('categories'));
        } else {
            return view('asset.index_user', compact('categories'));
        }
    }

    /**
     * Return JSON for Assets List
     *
     * @param \Illuminate\Http\Request $request
     */
    public function getJSON(Request $request)
    {
        $assets = new Asset();
        $per_page = 10;

        if($request->filled('name')) {
            $assets = $assets->where('name', 'like', '%' . $request->name . '%');
        }
        if($request->filled('sku')) {
            $assets = $assets->where('sku', 'like', '%' . $request->sku . '%');
        }
        if($request->filled('per_page')) {
            $per_page = $request->per_page;
        }

        if($assets->count() > 0 ) {
            $assets = $assets->with('category')->paginate($per_page)->appends($request->all());
            return new AssetCollection($assets);
        } else {
            return response()->json([
                'data' => [],
                'links' => [
                    'first' => null,
                    'last' => null,
                    'prev' => null,
                    'next' => null
                ],
                'meta' => [
                    'current_page' => 1,
                    'from' => 1,
                    'last_page' => 1,
                    'path' => null,
                    'per_page' => 10,
                    'to' => 10,
                    'total' => 0
                ]
            ]);
        }
    }

    /**
     * Store asset information.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate request
        $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'nullable|string|max:255|unique:assets',
            'price' => 'nullable|numeric',
            'quantity' => 'required|integer',
            'description' => 'string',
            'category' => 'integer'
        ],
        [
            'sku.unique' => 'SKU has already been taken.'
        ]);
        try {
            $asset = new Asset;
            $asset->name = $request->name;
            if($request->filled('sku')) {
                $asset->sku = $request->sku;
            }
            if($request->filled('price')) {
                $asset->price = $request->price;
            }
            $asset->quantity = $request->quantity;
            $asset->description = $request->description;
            $asset->category_id = $request->category;
            if($request->hasFile('image')) {
                $request->validate([
                    'image' => 'required|mimes:jpeg,jpg,png'
                ]);
                $asset->image = base64_encode(file_get_contents($request->image->path()));
            }
            $asset->save();
            Session::flash('success', 'Asset successfully added.');
        } catch(QueryException $e) {
            if($e->errorInfo[1] == 1264) {
                Session::flash('error', 'Price input too high. Please lower your price.');
            }
        }
        return redirect()->back();
    }

    /**
     * Show edit asset form.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $asset = Asset::findOrFail($id);
        $categories = Category::all();
        return view('asset.form', compact('asset', 'categories'));
    }

    /**
     * Update asset data.
     *
     * @param int $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'nullable|string|max:255',
            'price' => 'numeric',
            'quantity' => 'required|integer',
            'description' => 'string',
            'category' => 'required|integer'
        ]);
        try {
            $asset = Asset::findOrFail($id);
            $asset->update([
                'name' => $request->name,
                'sku' => $request->sku,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'description' => $request->description,
                'category_id' => $request->category
            ]);
            if($request->hasFile('image')) {
                $request->validate([
                    'image' => 'required|mimes:jpeg,jpg,png'
                ]);
                $asset->update([
                    'image' => base64_encode(file_get_contents($request->image->path()))
                ]);
            }
            Session::flash('success', 'Successfully updated asset.');
        } catch(QueryException $e) {
            if($e->errorInfo[1] == 1264) {
                Session::flash('error', 'Price has exceeded limit. Please lower asset price');
            }
            if($e->errorInfo[1] == 1062) {
                Session::flash('error', 'The SKU has already taken.');
            }
        }
        return redirect()->back();
    }

    /**
     * Remove asset from table.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $asset = Asset::findOrFail($id);
        try {
            $asset->delete();
            Session::flash('success', 'Successfully deleted asset.');
        } catch(QueryException $e) {
            // Add exception handler
        }
        return redirect()->back();
    }

    /**
     * Show borrowed asset list
     *
     * @return \Illuminate\Http\Response
     */
    public function borrowList()
    {
        return view('asset.borrow.index');
    }

    public function borrowAsset()
    {
        $assets = Asset::where('quantity', '>', 0)->get();
        return view('asset.borrow.form', compact('assets'));
    }


    public function borrowListUser()
    {
        return view('asset.borrow.user_list');
    }

    /**
     * Return JSON for Borrowed Asset List
     *
     * @param \Illuminate\Http\Request $request
     */
    public function borrowJSON(Request $request)
    {
        $borrows = new Borrow();
        $per_page = 10;

        if($request->filled('per_page')) {
            $per_page = $request->per_page;
        }

        if(Auth::guard('user')->check()) {
            $borrows = $borrows->where('user_id', Auth::user()->id);
        }

        if($borrows->count() > 0 ) {
            $borrows = $borrows->with('assets')->with('users')->paginate($per_page)->appends($request->all());
            return new AssetCollection($borrows);
        } else {
            return response()->json([
                'data' => [],
                'links' => [
                    'first' => null,
                    'last' => null,
                    'prev' => null,
                    'next' => null
                ],
                'meta' => [
                    'current_page' => 1,
                    'from' => 1,
                    'last_page' => 1,
                    'path' => null,
                    'per_page' => 10,
                    'to' => 10,
                    'total' => 0
                ]
            ]);
        }
    }

    public function borrow(Request $request)
    {
        $request->validate([
            'asset_id' => 'required|exists:assets,id'
        ]);
        $asset = Asset::find($request->asset_id);
        $request->validate([
            'quantity' => 'required|numeric|min:0|max:'.$asset->quantity
        ]);
        $asset->update([
            'quantity' => $asset->quantity - $request->quantity
        ]);
        $borrow = new Borrow();
        $borrow->user_id = Auth::user()->id;
        $borrow->asset_id = $request->asset_id;
        $borrow->quantity = $request->quantity;
        $borrow->save();
        Session::flash('success', 'Asset successfully borrowed');
        return redirect()->back();
    }

    public function returnAsset($id)
    {
        $borrow = Borrow::find($id);
        $asset = Asset::find($id);
        try {
            $borrow->update([
                'status' => 1
            ]);
            $asset->update([
                'quantity' => $asset->quantity + $borrow->quantity
            ]);
        } catch(QueryException $e) {
            echo '<pre>';
            print_r($e->errorInfo);
            echo '</pre>';
            die();
        }
        Session::flash('success', 'Asset successfully returned.');
        return redirect()->back();
    }

    /**
     * Show edit asset form.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function viewAsset($id)
    {
        $asset = Asset::findOrFail($id);
        return view('asset.view', compact('asset'));
    }
}
