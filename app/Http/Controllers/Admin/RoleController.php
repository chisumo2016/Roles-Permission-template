<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
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
        return view('admin.roles.edit', compact('role'));
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

}
