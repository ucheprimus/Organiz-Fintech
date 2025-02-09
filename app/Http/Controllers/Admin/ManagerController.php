<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Manager;
use App\Models\Role;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    //
    

    public function index()
    {

        // Get all managers, with their related branch and role data
        $managers = Manager::with(['branch', 'role'])->get();
        $branches = Branch::all();  // Get all branches
        $roles = Role::all(); // Fetch all roles
        return view ('admin.manager', compact('managers','branches', 'roles'));
    }


    public function store(Request $request)
    {
        // Validate the manager details
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:managers,email',
            'phone_number' => 'required|string|max:20',
            'branch_id' => 'required|exists:branches,id',  // Validate branch exists
            'role_id' => 'required|exists:roles,id',  // Validate role exists
            'start_date' => 'required|date',
            'salary' => 'required|numeric',
            'status' => 'required|in:active,inactive',
            'password' => 'required|min:6',
        ]);

        // Create the manager
        Manager::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'branch_id' => $request->branch_id,
            'role_id' => $request->role_id,
            'start_date' => $request->start_date,
            'salary' => $request->salary,
            'status' => $request->status,
            'password' => bcrypt($request->password),  // Hash the password
        ]);

        return redirect()->route('adminmanager')->with('success', 'Manager created successfully!');
    }

    // Show the form for editing the specified manager
    public function edit($id)
    {
        $manager = Manager::findOrFail($id); // Use singular variable name for consistency
        $branches = Branch::all();
        $roles = Role::all();

        return view('admin.edits.manager', compact('manager', 'branches', 'roles')); // Pass $manager instead of $managers
    }



    // Update the specified manager
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:managers,email,' . $id,
            'phone_number' => 'required|string|max:20',
            'branch_id' => 'required|exists:branches,id',
            'role_id' => 'required|exists:roles,id',
            'start_date' => 'required|date',
            'salary' => 'required|numeric',
            'status' => 'required|in:active,inactive',
            'password' => 'nullable|string|min:6',
        ]);

        $managers = Manager::findOrFail($id);
        $managers->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'branch_id' => $request->branch_id,
            'role_id' => $request->role_id,
            'start_date' => $request->start_date,
            'salary' => $request->salary,
            'status' => $request->status,
            'password' => $request->password ? bcrypt($request->password) : $managers->password, // update password only if provided
        ]);

        return redirect()->route('adminmanager')->with('success', 'Manager updated successfully!');
    }

    // Remove the specified manager from storage
    public function destroy($id)
    {
        $manager = Manager::findOrFail($id);
        $manager->delete();

        return redirect()->route('adminmanager')->with('success', 'Manager deleted successfully!');
    }

}
