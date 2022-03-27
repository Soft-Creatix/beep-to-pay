<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth:admin', 'role:Super Admin']);
    }

    /**
     * Display a listing of the permission.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::all();
        return view('admin.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new permission.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.permissions.create');
    }

    /**
     * Store a newly created permission in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePermissionRequest $request)
    {
        Permission::create(['name' => $request->name]);
        return redirect()->route('permission.index')->with('success', 'New permission has been added!');
    }

    /**
     * Show the form for editing the specified permission.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = Permission::where('id', $id)->first();
        return view('admin.permissions.edit', compact('permission'));
    }

    /**
     * Update the specified permission in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePermissionRequest $request, $id)
    {
        $permissionUser = Permission::withCount('users')->where('id', $id)->get()->first();
        $permissionUserCount = $permissionUser['users_count'];

        $permissionRole = Permission::withCount('roles')->where('id', $id)->get()->first();
        $permissionRoleCount = $permissionRole['roles_count'];

        if($permissionUserCount > 0 || $permissionRoleCount > 0) {
            return redirect()->route('permission.index')->with('warning','Permission cannot be updated as it is assigned to user(s)/role(s).');
        }

        $permission = Permission::find($id);
        $permission->name = $request->name;
        $permission->save();
        return redirect()->route('permission.index')->with('success','Permission updated successfully!');
    }

    /**
     * Remove the specified permission from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permissionUser = Permission::withCount('users')->where('id', $id)->get()->first();
        $permissionUserCount = $permissionUser['users_count'];

        $permissionRole = Permission::withCount('roles')->where('id', $id)->get()->first();
        $permissionRoleCount = $permissionRole['roles_count'];

        if($permissionUserCount > 0 || $permissionRoleCount > 0) {
            return redirect()->route('permission.index')->with('warning','Permission cannot be deleted as it is assigned to user(s)/role(s).');
        }

        Permission::destroy($id);
        return redirect()->route('permission.index')->with('success','Permission deleted successfully!');
    }
}
