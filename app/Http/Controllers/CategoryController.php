<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;

class CategoryController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = Category::latest()->get();
       
        return view('discussions.categories.index', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description'  => 'required'
        ]);

        $category = new Category();
        
        $category->name = $request->title;
        $category->description = $request->description;

        $category->save();

        return redirect($category->path());
    }

    public function create() {
        return view('discussions.categories.add');
    }
}
