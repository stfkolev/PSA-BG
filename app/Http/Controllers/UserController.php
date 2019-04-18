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

use Illuminate\Support\Facades\DB;

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

     public function adminIndex() {
        $users = \App\User::with('roles')->get();

        return view('admin.users.index', ['users' => $users]);
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

    public function edit($id) {
        $user = \App\User::find($id);

        return view('admin.users.edit', ['user' => $user]);
    }

    public function save($id, Request $request) {
        $this->validate($request, [
            'name' => 'max:32|nullable',
            'email' => 'max:32|nullable',
            'password' => 'max:64|confirmed|nullable',
            'description' => 'max:128|nullable',
            'customurl' => 'max:10|nullable'
        ]);

        $user = \App\User::find($id);

        $query = DB::table('users')->where('id', $id)
                    ->update([
                        'name' => isset($request->name) ?: $user->name,
                        'email' => isset($request->email) ?: $user->email,
                        'password' => isset($request->password) ? Hash::make($request->password) : $user->password,
                        'description' => isset($request->description) ?: $user->description,
                        'customurl' => $request->customurl ?: $user->customurl,
                    ]);

        return redirect(route('users.admin'));
    }
}
