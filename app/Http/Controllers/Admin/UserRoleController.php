<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRoleRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserRoleController extends Controller
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
     * Display a listing of the user & role.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('roles')->get();
        return view('admin.user-role.index', compact('users'));
    }

    /**
     * Show the form for editing the specified user & role.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id', $id)->with('roles')->get()->first();
        $roles = Role::all();
        return view('admin.user-role.edit', compact('user','roles'));
    }

    /**
     * Update the specified user & role in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRoleRequest $request, $id)
    {
        $user = User::find($id);
        $user->syncRoles($request->role);
        return redirect()->route('user-role.index')->with('success','User role updated successfully!');
    }
}
