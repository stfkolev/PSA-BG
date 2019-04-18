<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Permission;

class RoleController extends Controller
{
    public function index() {
        $roles = \App\Role::all();

        return view('admin.roles.index', ['roles' => $roles]);
    }

    public function create() {
        return view('admin.roles.add');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'displayName' => 'required',
            'name' => 'required',
            'description' => 'required'
        ]);

        $role = new Role();

        $role->display_name = $request->displayName;
        $role->name = $request->name;
        $role->description = $request->description;

        $role->save();

        return redirect(route('roles'));
    }

    public function permissions($id) {
        $permissions = \App\Permission::all();
        $role = \App\Role::find($id);

        return view('admin.roles.permissions', ['privilegies' => $permissions, 'role' => $role]);
    }

    public function storePermissions($id, Request $request) {
        $privilegies = $request->input('role_privilegies');

        $role = \App\Role::find($id);
        
        $role->syncPermissions($privilegies);

        return redirect(route('roles'));
    }
}
