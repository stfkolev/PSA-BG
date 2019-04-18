<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Permission;

class PrivilegeController extends Controller
{
    public function index() {
        $permissions = \App\Permission::all();

        return view('admin.privileges.index', ['privilegies' => $permissions]);
    }

    public function create() {
        return view('admin.privileges.add');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'displayName' => 'required',
            'name' => 'required',
            'description' => 'required'
        ]);

        $permission = new Permission();

        $permission->display_name = $request->displayName;
        $permission->name = $request->name;
        $permission->description = $request->description;

        $permission->save();

        return redirect(route('privileges'));
    }
}
