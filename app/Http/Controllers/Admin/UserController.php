<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserPasswordRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Jobs\UserCreationEmailJob;
use App\Mail\UserCreationMailable;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use InvalidArgumentException;
use Spatie\Permission\Models\Role;

class UserController extends Controller
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
     * Display a listing of the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with(['roles'])->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create' ,compact('roles'));
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'contact_no' => $request->contact_no,
                'designation' => $request->designation,
            ]);

        $user->assignRole($request->role);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = time() .'-'. $file->getClientOriginalName();
            $filePath = 'portal/uploads/user/' . $name;
            Storage::disk('s3')->put($filePath, file_get_contents($file));

            $image = new Image();
            $image->url = 'https://s3.' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/' . $filePath;
            $user->image()->save($image);
        }

        UserCreationEmailJob::dispatch($request->email, $request->name);

        return redirect()->route('user.index')->with('success', 'New user has been added!');
    }

    /**
     * Display the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::all();
        $user = User::find($id);
        return view('admin.users.edit' ,compact('roles', 'user'));
    }

    /**
     * Update the specified user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        if($request->password != null) {
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->contact_no = $request->contact_no;
            $user->designation = $request->designation;
            $user->save();
        } else {
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->contact_no = $request->contact_no;
            $user->designation = $request->designation;
            $user->save();
        }

        $user = User::find($id);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = time() .'-'. $file->getClientOriginalName();
            $filePath = 'portal/uploads/user/' . $name;
            Storage::disk('s3')->put($filePath, file_get_contents($file));

            $url = 'https://s3.' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/' . $filePath;
            $user->image()->update(['url' => $url]);
        }

        if(auth()->user()->id == $id && $request->role != auth()->user()->roles[0]->name) {
            return redirect()->route('user.index')->with('warning','User role cannot be changed as it is signed in.');
        } else {
            $user->syncRoles($request->role);
        }

        return redirect()->route('user.index')->with('success','User updated successfully!');
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(auth()->user()->id == $id) {
            return redirect()->route('user.index')->with('warning','User cannot be deleted as it is signed in.');
        } else {
            User::destroy($id);
        }
        return redirect()->route('user.index')->with('success','User deleted successfully!');
    }

    /**
     * Show the form for editing the specified user's password.
     *
     * @return \Illuminate\Http\Response
     */
    public function editPassword()
    {
        return view('admin.users.change-password');
    }

    /**
     * Update the specified user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(UpdateUserPasswordRequest $request)
    {
        $id = auth()->user()->id;
        try {
            $user = User::where('id', $id)->update(['password'=> Hash::make($request->password)]);
            // Auth::logoutOtherDevices($request->password);
        } catch(InvalidArgumentException $e) {
            return redirect()->route('user.password.edit')->with('error','Current password is not valid!');
        }
        return redirect()->route('user.password.edit')->with('success','Password updated successfully!');
    }
}
