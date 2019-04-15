<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Requests;
use \App\Reply;
use \App\User;

use Auth;

class RequestsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the requests dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $requests = \App\Requests::with('user')->get();

        return view('requests', ['requests' => $requests]);
    }
    
    public function store(Request $request) {
        $requests = new Requests;

        $requests->user_id = Auth::user()->id;
        $requests->size = $request->size;
        $requests->type = $request->type;
        $requests->topic = $request->topic;
        $requests->more = $request->more;

        $requests->save();

        return redirect('/requests' . $request->$id);
    }

    public function look($id) {
        $request = \App\Requests::with('user')->with('replies')->find($id)->get();

        return view('requests/view', ['request' => $request]);
    }

    public function reply($requestId, Request $request) {
        $reply = new Reply;

        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        $imageName = time().'.'.request()->image->getClientOriginalExtension();
        $request->image->move(public_path('uploads\requests'), $imageName);

        $reply->user_id = Auth::user()->id;
        $reply->requests_id = $requestId;

        $reply->image = '\\uploads\\requests\\' . $imageName;
        $reply->best = false;
        
        $reply->save();

        return back();
    }
}
