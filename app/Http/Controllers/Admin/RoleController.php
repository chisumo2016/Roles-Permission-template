<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::whereNotIn('name', ['admin'])->get();
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            //'permissions' => 'required',
        ]);

        $role = Role::create(['name' => $request->input('name')]);
        //$role->syncPermissions($request->input('permissions'));

        return redirect()->route('admin.roles.index')
            ->with('success', 'Role created successfully');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name' => 'required|unique:roles,name,'.$role->id,
        ]);

        $role->update($validated);

        return redirect()->route('admin.roles.index')
            ->with('success', 'Role updated successfully');
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('admin.roles.index')
            ->with('success', 'Role deleted successfully');
    }

    public function givePermission(Request $request, Role $role)
    {
        if($role->hasPermissionTo($request->input('permission'))){
          return back()->with('success', 'Permission exists');
        }
        $role->givePermissionTo($request->input('permission'));

        return redirect()->route('admin.roles.edit', $role->id)
            ->with('success', 'Permission added successfully');
    }

    public function removePermission( Role $role,Permission $permission)
    {
        if(!$role->hasPermissionTo($permission)){
          return back()->with('success', 'Permission does not exist');
        }
        $role->revokePermissionTo($permission);

        return redirect()->route('admin.roles.edit', $role->id)
            ->with('success', 'Permission removed successfully');
    }

}
