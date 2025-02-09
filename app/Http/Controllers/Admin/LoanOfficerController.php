<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\LoanOfficer;
use App\Models\Manager;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class LoanOfficerController extends Controller
{
    public function index()
    {
        // Fetch loan officers with their related models (manager, branch, role)
        $officers = LoanOfficer::with(['manager', 'role', 'branch'])->get(); // Fetch all loan officers

        // dd($officers);

        // Fetch other related models if needed
        $managers = Manager::with(['branch', 'role'])->get();
        $branches = Branch::all();
        $roles = Role::all();

        // Pass all data to the view
        return view('admin.loanofficer', compact('officers', 'managers', 'branches', 'roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'dob' => 'required|date',
            'nationality' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:loan_officers',
            'street_address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'postal_code' => 'required',
            'ssn' => 'required',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg',
            'employee_id' => 'required|unique:loan_officers',
            'role_id' => 'required|exists:roles,id',
            'manager_id' => 'required|exists:managers,id',
            'branch' => 'required',
            'date_of_hire' => 'required|date',
            'employment_status' => 'required',
            'employment_type' => 'required',
            'work_schedule' => 'required|integer',
        ]);

        if ($request->hasFile('profile_picture')) {
            $validated['profile_picture'] = $request->file('profile_picture')->store('profile_pictures', 'public');
        }


        LoanOfficer::create($validated);

        return redirect()->route('adminloanofficer')->with('success', 'Loan Officer created successfully.');
    }

    public function edit($id)
    {
        $officer = LoanOfficer::findOrFail($id); // Retrieve the officer by ID
        $managers = Manager::all();
        $roles = Role::all();
        $branches = Branch::all();
        return view('admin.edits.loanofficer', compact('officer', 'managers', 'roles', 'branches'));
    }


    public function update(Request $request, LoanOfficer $loanOfficer)
    {
        // Validate input with conditional rules for unique fields
        $validated = $request->validate([
            'first_name' => 'nullable|string',
            'last_name' => 'nullable|string',
            'gender' => 'nullable|string',
            'dob' => 'nullable|date',
            'nationality' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => [
                'nullable',
                'email',
                Rule::unique('loan_officers')->ignore($loanOfficer->id), // Exclude current officer from unique check
            ],
            'street_address' => 'nullable|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'postal_code' => 'nullable|string',
            'ssn' => 'nullable|numeric', // Allow only numbers
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:1048',
            'employee_id' => [
                'nullable',
                Rule::unique('loan_officers')->ignore($loanOfficer->id), // Exclude current officer from unique check
            ],
            'role_id' => 'nullable|exists:roles,id',
            'manager_id' => 'nullable|exists:managers,id',
            'branch' => 'nullable|string',
            'date_of_hire' => 'nullable|date',
            'employment_status' => 'nullable|string',
            'employment_type' => 'nullable|string',
            'work_schedule' => 'nullable|integer|min:1|max:80',
        ]);

        // Check for changes
        $changes = array_filter($validated, function ($value, $key) use ($loanOfficer) {
            return $loanOfficer->{$key} !== $value;
        }, ARRAY_FILTER_USE_BOTH);

        if (empty($changes) && !$request->hasFile('profile_picture')) {
            return redirect()->back()->with('warning', 'No changes made.');
        }

        // Handle profile picture update
        if ($request->hasFile('profile_picture')) {
            $validated['profile_picture'] = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        // Update the loan officer with the validated data
        $loanOfficer->update($validated);

        // Redirect back with a success message
        return redirect()->route('admin.loanofficer')->with('success', 'Loan Officer updated successfully.');
    }




    public function destroy(LoanOfficer $loanOfficer)
    {
        $loanOfficer->delete();

        return redirect()->route('adminloanofficer')->with('success', 'Loan Officer deleted successfully.');
    }
}
