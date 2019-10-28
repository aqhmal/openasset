<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Http\Resources\CategoryCollection;

class CategoryController extends Controller
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
     * Display categories list and add category form.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::guard('admin')->check()) {
            return view('category.index');
        } else {
            return view('category.index_user');
        }
    }

    /**
     * Return JSON for Categories List
     *
     * @param \Illuminate\Http\Request $request
     */
    public function getJSON(Request $request)
    {
        $categories = new Category();
        $per_page = 10;

        if($request->filled('name')) {
            $categories = $categories->where('name', 'like', '%'.$request->name.'%');
        }
        if($request->filled('per_page')) {
            $per_page = $request->per_page;
        }

        if($categories->count() > 0) {
            $categories = $categories->withCount('assets')->paginate($per_page)->appends($request->all());
            return new CategoryCollection($categories);
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
     * Store new category into table.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50|unique:categories'
        ], [
            'name.unique' => 'Category name already taken.'
        ]);
        try {
            $category = new Category();
            $category->name = $request->name;
            $category->save();
            Session::flash('success', 'Succesfully added category.');
        } catch(QueryException $e) {
            if($e->errorInfo[1] == 1062) {
                Session::flash('error', 'Category name already taken.');
            }
        }
        return redirect()->back();
    }

    /**
     * Show edit category form.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $category = Category::findOrFail($id);
        return view('category.form', compact('category'));
    }

    /**
     * Update category information.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:50|unique:categories'
        ], [
            'name.unique' => 'Category name already taken.'
        ]);
        $category = Category::findOrFail($id);
        try {
            $category->name = $request->name;
            $category->save();
            Session::flash('success', 'Succesfully updated category.');
        } catch(QueryException $e) {
            if($e->errorInfo[1] == 1062) {
                Session::flash('error', 'Category name already taken.');
            }
        }
        return redirect()->back();
    }

    /**
     * Delete category from table.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $category = Category::findOrFail($id);
        try {
            $category_name = $category->name;
            $category->delete();
            Session::flash('success', 'Succesfully deleted category.');
        } catch(QueryException $e) {
            if($e->errorInfo[1] == 1451) {
                Session::flash('error', 'Category is associated with one or more asset. Change asset\'s category to delete category.');
            }
        }
        return redirect()->back();
    }
}
