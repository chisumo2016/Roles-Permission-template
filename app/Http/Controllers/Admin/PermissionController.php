<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        return view('admin.permissions.index',compact('permissions'));
    }

    public function create()
    {
        return view('admin.permissions.create');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
           'name' => 'required|unique:permissions,name',
       ]);

        Permission::create($validate);

        return redirect()->route('admin.permissions.index')
            ->with('success','Permission created successfully.');
    }

    public function edit(Permission $permission)
    {
        $roles = Role::all();
        return view('admin.permissions.edit',compact('permission','roles'));
    }

    public function update(Request $request, Permission $permission)
    {

        $validate = $request->validate([
            'name' => 'required|unique:permissions,name,'.$permission->id,
        ]);

        $permission->update($validate);

        return redirect()->route('admin.permissions.index')
            ->with('success','Permission updated successfully.');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();

        return redirect()->route('admin.permissions.index')
            ->with('success','Permission deleted successfully.');
    }

    public function assignRole(Request $request, Permission $permission)
    {
       if ($permission->hasRole($request->role)) {
           return back()->with('success','Role exists.');
       }
       $permission->assignRole($request->role);
        return back()->with('success','Role  assigned.');
    }

    public function removeRole(Permission $permission, Role $role)
    {
        if ($permission->hasRole($role)) {
            $permission->removeRole($role);
            return back()->with('success','Role Removed successfully.');
        }
        return back()->with('success','Role does not exist.');

    }

}
