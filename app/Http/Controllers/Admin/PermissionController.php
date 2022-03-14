<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

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
           'name' => 'required|unique:permissions,name,'.$permission->id,
       ]);

        Permission::create($validate);

        return redirect()->route('admin.permissions.index')
            ->with('success','Permission created successfully.');
    }

    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit',compact('permission'));
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

}
