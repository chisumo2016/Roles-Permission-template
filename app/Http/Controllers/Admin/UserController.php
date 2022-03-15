<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index' , compact('users'));
    }

    public function show(User $user)
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('admin.users.show' , compact('user','roles','permissions'));
    }

    public function assignRole(Request $request, User $user)
    {
        if ($user->hasRole($request->role)) {
            return back()->with('success','Role exists.');
        }
        $user->assignRole($request->role);
        return back()->with('success','Role  assigned.');
    }

    public function removeRole(User $user, Role $role)
    {
        if ($user->hasRole($role)) {
            $user->removeRole($role);
            return back()->with('success','Role Removed successfully.');
        }
        return back()->with('success','Role does not exist.');

    }
    public function givePermission(Request $request, User $user )
    {
        if($user->hasPermissionTo($request->input('permission'))){
            return back()->with('success', 'Permission exists');
        }
        $user->givePermissionTo($request->input('permission'));

        return redirect()->route('admin.roles.edit', $user->id)
            ->with('success', 'Permission added successfully');
    }

    public function removePermission( User $user ,Permission $permission)
    {
        if(!$user->hasPermissionTo($permission)){
            return back()->with('success', 'Permission does not exist');
        }
        $user->revokePermissionTo($permission);

        return redirect()->route('admin.roles.edit', $user->id)
            ->with('success', 'Permission removed successfully');
    }

    public function destroy(User $user)
    {
        if($user->hasRole('admin')){
            return back()->with('success', 'You are Admin');
        }
        $user->delete();
        return back()->with('success', 'User deleted successfully');
    }



}
