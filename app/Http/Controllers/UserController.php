<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rule;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }
    public function index()
    {
        $users = User::with('roles')->get();
        $roles = Role::all();
        return view('users.index', compact('users','roles'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        $userRole = Role::where('name', 'user')->firstOrFail();
        $user->assignRole($userRole);

        $userPermissions = $userRole->permissions;
        foreach ($userPermissions as $permission) {
            $user->givePermissionTo($permission);
        }
        return redirect()->route('users.index')->with('success', 'User added successfully');
    }



    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
        ]);
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);
        if(!empty($request->roles)){
            $user->roles()->sync($request->input('roles', []));

                $permissions = $user->roles->flatMap(function ($role) {
                    return $role->permissions;
                })->unique()->pluck('id')->toArray();
                $uniquePermissions = array_unique($permissions);
                $user->permissions()->detach();
                $user->permissions()->attach($uniquePermissions);

        }
        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}
