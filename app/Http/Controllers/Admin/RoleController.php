<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Contracts\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
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
     * Display a listing of the role.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new role.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created role in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRoleRequest $request)
    {
        Role::create(['name' => $request->name]);
        return redirect()->route('role.index')->with('success', 'New role has been added!');
    }

    /**
     * Show the form for editing the specified role.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::where('id', $id)->first();
        return view('admin.roles.edit', compact('role'));
    }

    /**
     * Update the specified role in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoleRequest $request, $id)
    {
        $roleUser = Role::withCount('users')->where('id', $id)->get()->first();
        $roleUserCount = $roleUser['users_count'];

        $rolePermission = Role::withCount('permissions')->where('id', $id)->get()->first();
        $rolePermissionCount = $rolePermission['permissions_count'];

        if($roleUserCount > 0 || $rolePermissionCount > 0) {
            return redirect()->route('role.index')->with('warning','Role cannot be updated as it is assigned to user(s)/permission(s).');
        }

        $role = Role::find($id);
        $role->name = $request->name;
        $role->save();
        return redirect()->route('role.index')->with('success','Role updated successfully!');
    }

    /**
     * Remove the specified role from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $roleUser = Role::withCount('users')->where('id', $id)->get()->first();
        $roleUserCount = $roleUser['users_count'];

        $rolePermission = Role::withCount('permissions')->where('id', $id)->get()->first();
        $rolePermissionCount = $rolePermission['permissions_count'];

        if($roleUserCount > 0 || $rolePermissionCount > 0) {
            return redirect()->route('role.index')->with('warning','Role cannot be deleted as it is assigned to user(s)/permission(s).');
        }

        Role::destroy($id);
        return redirect()->route('role.index')->with('success','Role deleted successfully!');
    }
}
