<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateRolePermissionsRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionsController extends Controller
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
     * Display a listing of the role & permissions.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::with('permissions')->get();
        return view('admin.role-permissions.index', compact('roles'));
    }

    /**
     * Show the form for editing the specified role & permissions.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::where('id', $id)->with('permissions')->get()->first();
        $permissions = Permission::all();
        return view('admin.role-permissions.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified role & permissions in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRolePermissionsRequest $request, $id)
    {
        $role = Role::findById($id);
        $role->syncPermissions($request->permissions);
        return redirect()->route('role-permissions.index')->with('success','Role permissions updated successfully!');
    }
}
