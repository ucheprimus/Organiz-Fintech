<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    //
    public function index()
    {
        $branches = Branch::all();  // Get all branches
        return view ('admin.branch', compact('branches'));
    }

    public function store(Request $request)
    {
        // Validate form data
        $request->validate([
            'branch_name' => 'required|string|max:255|unique:branches', // Ensure branch name is unique
            'branch_location' => 'required|string|max:255',
        ]);

        try {
            // Generate the branch code
            $branch_name = strtoupper($request->branch_name);
            $branch_code = substr($branch_name, 0, 3) . rand(10000, 99999);  // 3 letters + 5 random numbers

            // Create and save the branch
            $branch = Branch::create([
                'branch_name' => $request->branch_name,
                'branch_location' => $request->branch_location,
                'branch_code' => $branch_code,
            ]);

            // Redirect with success message if creation is successful
            return redirect()->route('adminbranchindex')->with('success', 'Branch created successfully!');
        } catch (\Illuminate\Database\QueryException $e) {
            // Catch the database exception (e.g., duplicate entry for branch name)

            // Check if the exception is a unique constraint violation
            if ($e->getCode() == 23000) {
                // Custom error message when a duplicate branch name is found
                return redirect()->back()->withErrors([
                    'branch_name' => 'This branch name is already taken. Please choose a different one.'
                ]);
            }

            // For other database errors, return a generic message
            return redirect()->back()->withErrors([
                'error' => 'An error occurred while creating the branch. Please try again later.'
            ]);
        }
    }


    public function edit($id)
    {
        $branch = Branch::findOrFail($id);
        return view('admin.edits.branch', compact('branch'));
    }



    public function update(Request $request, $id)
    {
        // Find the branch to update
        $branch = Branch::findOrFail($id);

        // Validate the form data, except for the current branch being updated
        $request->validate([
            'branch_name' => 'required|string|max:255|unique:branches,branch_name,' . $branch->id, // Ignore the current branch
            'branch_location' => 'required|string|max:255',
            'branch_code' => 'required|string|max:255|unique:branches,branch_code,' . $branch->id, // Ignore the current branch
        ]);

        // Update the branch details
        $branch->update([
            'branch_name' => $request->branch_name,
            'branch_location' => $request->branch_location,
            'branch_code' => $branch->branch_code,  // Branch code remains the same (generated previously)
        ]);

        // Redirect with success message
        return redirect()->route('adminbranchindex')->with('success', 'Branch updated successfully!');
    }

    public function destroy($id)
    {
        $branch = Branch::findOrFail($id);
        $branch->delete();
        return redirect()->route('adminbranchindex')->with('success', 'Branch deleted successfully!');
    }

}


