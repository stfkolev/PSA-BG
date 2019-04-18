<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;
use \App\Requests;
use \App\Shot;
use \App\Reply;
use \App\Role;
use \App\Permission;

use Auth;

class UserController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
     public function index() {
        $users = \App\User::with('roles')->get();

        return view('members.index', ['users' => $users]);
     }
     
    public function avatar()
    {
        return view('profile.settings.avatar');
    }

     /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request) {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:max_width=200,max_height=200',

        ]);
        
        $user = \App\User::find(Auth::user()->id);

        $imageName = time().'.'.request()->image->getClientOriginalExtension();
        $request->image->move(public_path('avatars'), $imageName);

        $user->avatar = '\\uploads\\avatars\\' . $imageName;

        $user->save();

        return back()
            ->with('success','You have successfully uploaded your avatar.')
            ->with('image',$imageName);
    }

    public function ownProfile() {
        $user = Auth::user();

        $requests = \App\Requests::findOrFail($user->id)::all();
        $shots = \App\Shot::findOrFail($user->id)::all();
        $replies = \App\Reply::findOrFail($user->id)::all();
        

        return view('profile.index', ['user' => $user, 'requests' => $requests, 'shots' => $shots, 'replies' => $replies]);
    }

    public function profile($id) {
        if($id === Auth::user()->id)
            return redirect('/profile');

        $user = \App\User::where('id', $id)->orWhere('customurl', $id)->with('requests')->with('shots')->with('replies')->with('answers')->get();
        
        return view('profile.user', ['user' => $user]);
    }

    public function newRole() {
       \App\Role::find(1)->attachPermission('manage-requests');
    }
}
