<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
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

        $category = Category::create([
            'name' => request('title'),
            'description'  => request('description')
        ]);

        return redirect($category->path());
    }

    public function create() {
        return view('discussions.categories.add');
    }
}
