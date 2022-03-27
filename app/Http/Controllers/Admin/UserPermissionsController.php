<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class UserPermissionsController extends Controller
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
     * Display a listing of the user & permissions.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('permissions')->get();
        return view('admin.user-permissions.index', compact('users'));
    }

    /**
     * Show the form for editing the specified user & permissions.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id', $id)->with('permissions')->get()->first();
        $permissions = Permission::all();
        return view('admin.user-permissions.edit', compact('user', 'permissions'));
    }

    /**
     * Update the specified user & permissions in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->syncPermissions($request->permissions);
        return redirect()->route('user-permissions.index')->with('success','User permissions updated successfully!');
    }
}
