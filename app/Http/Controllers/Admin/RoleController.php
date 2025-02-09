<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    //

    public function index()
    {
        $roles = Role::all(); // Fetch all roles
        return view ('admin.roles', compact('roles'));

    }

    public function store(Request $request)
    {
        $request->validate([
            'role_name' => 'required|string|max:255|unique:roles,role_name',
        ]);

        Role::create([
            'role_name' => $request->role_name,
        ]);

        return redirect()->route('adminrole')->with('success', 'Role created successfully!');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('adminrole')->with('success', 'Role deleted successfully!');
    }

}
