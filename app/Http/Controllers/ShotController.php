<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Shot;

use Auth;

class ShotController extends Controller
{
    public function index() {
        $shots = \App\Shot::with('user')->get();
        
        return view('shots.index', ['shots' => $shots]);
    }

    public function store(Request $request) {
        $shot = new \App\Shot;

        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        $shot->title = $request->title;
        $shot->description = $request->description;
        $shot->user_id = Auth::user()->id;
        $shot->tags = json_encode(['default', 'test']);

        $imageName = time().'.'.request()->image->getClientOriginalExtension();
        $request->image->move(public_path('uploads\shots'), $imageName);

        $shot->image = '\\uploads\\shots\\' . $imageName;
        
        $shot->save();

        return back()
                ->with('success','You have successfully uploaded your shot.')
                ->with('image', $imageName);
    }

    public function like($id) {
        $shot = \App\Shot::find($id);
       
        if(Auth::user()->hasLiked($shot))
            Auth::user()->unlike($shot);
        else
            Auth::user()->like($shot);

        return back();
    }

    public function view($id) {
        $shot = \App\Shot::where('id', $id)->with('user')->get();
        $currShot = \App\Shot::find($id);

        return view('shots.view', ['shot' => $shot]);
    }

    public function mine() {
        $shots = \App\Shot::where('user_id', Auth::user()->id)->get();
        
        return view('shots.mine', ['shots' => $shots]);
    }

    public function mylikes() {
        $likes = Auth::user()->likedItems();

        return view('shots.likes', ['likes' => $likes]);
    }
}
