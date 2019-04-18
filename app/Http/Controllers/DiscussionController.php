<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Discussion;
use App\Category;

use Auth;

class DiscussionController extends Controller
{

    /**
     * DiscussionController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discussions = Discussion::latest()->with('category')->get();
        $categories = \App\Category::all();
       
        return view('discussions.index', ['discussions' => $discussions, 'categories' => $categories]);
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = \App\Category::all();

        return view('discussions.create', ['categories' => $categories]);
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
            'body'  => 'required',
            'category_id' => 'required|exists:categories,name'
        ]);
        
        $category = \App\Category::where('name', '=', $request->category_id)->get();

        $discussion = Discussion::create([
            'user_id' => auth()->id(),
            'category_id' => $category[0]->id,
            'title' => request('title'),
            'body'  => request('body')
        ]);

        return redirect($discussion->path());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Discussion  $discussion
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category, Discussion $discussion)
    {
        return view('discussions.show', ['discussion' => $discussion, 'category' => $category]);
    }

     /**
     * Display the specified resource.
     *
     * @param  \App\Discussion  $discussion
     * @return \Illuminate\Http\Response
     */
    public function showByCategory(Category $category)
    {
        $discussions = \App\Discussion::where('category_id', '=', $category->id)->get();
        $categories = \App\Category::all();

        return view('discussions.showByCategory', ['discussions' => $discussions, 'categories' => $categories, 'currentCategory' => $category->id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Discussion  $discussion
     * @return \Illuminate\Http\Response
     */
    public function edit(Discussion $discussion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Discussion  $discussion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Discussion $discussion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Discussion  $discussion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discussion $discussion)
    {
        //
    }

    public function mine() {
        $discussions = Discussion::where('user_id', '=', Auth::user()->id)->with('category')->get();

        return view('discussions.mine', ['discussions' => $discussions]);
    }
}
