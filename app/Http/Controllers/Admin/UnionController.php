<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\LoanOfficer;
use App\Models\Manager;
use App\Models\Role;
use App\Models\Union;
use App\Models\UnionMember;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UnionController extends Controller
{


    public function index()
    {
        // Fetch the role with the name "Union Officer"
        $mena = DB::table('roles')->where('role_name', "Union Officer")->first();
    
        // Check if the role exists
        if (!$mena) {
            // If the role doesn't exist, pass an empty collection and a notice
            return view('admin.union', [
                'officers' => collect(), // Empty collection
                'unions' => collect(),   // Empty collection for unions
                'notice' => 'No Union Officer role exists yet.',
            ]);
        }
    
        // Fetch officers with their manager and branch relationships
        $officers = LoanOfficer::where('role_id', $mena->id)
            ->with(['manager.branch']) // Include relationships
            ->get();
    
        // Fetch all unions with their relationships
        $unions = Union::with(['officer', 'branch', 'manager'])->get();
    
        // Pass variables to the view
        return view('admin.union', compact('officers', 'unions'));
    }
    



    public function store(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'union_name' => 'required|string|max:255',
            'union_leader' => 'required|string|max:255',
            'number_of_members' => 'required|integer',
            'location' => 'required|string|max:255',
            'union_officer' => 'required|exists:loan_officers,id', // Validate officer ID
        ]);
    
        // Fetch the loan officer and its relationships (manager and branch)
        $officer = LoanOfficer::with(['manager', 'manager.branch'])->find($validated['union_officer']);
    
        if (!$officer) {
            return redirect()->back()->withErrors(['union_officer' => 'The selected Union Officer does not exist.']);
        }
    
        // Retrieve related manager and branch
        $manager = $officer->manager; // Officer's manager
        $branch = $manager ? $manager->branch : null; // Manager's branch
    
        if (!$manager || !$branch) {
            return redirect()->back()->withErrors(['union_officer' => 'The selected Union Officer does not have an assigned manager or branch.']);
        }
    
        // Create the union in the database
        $union = new Union();
        $union->union_name = $validated['union_name'];
        $union->union_leader = $validated['union_leader'];
        $union->number_of_members = $validated['number_of_members'];
        $union->location = $validated['location'];
        $union->officer_id = $validated['union_officer']; // Assign officer ID

        $union->save();
    
        // Redirect with a success message
        return redirect()->route('adminunion')->with('success', 'Union created successfully!');
    }
    
    public function edit($id)
    {
        // Fetch the union to edit
        $union = Union::findOrFail($id);
    
        // Fetch the role with the name "Union Officer"
        $mena = DB::table('roles')->where('role_name', "Union Officer")->first();
    
        // Check if the role exists
        if (!$mena) {
            // If the role doesn't exist, pass an empty collection and a notice
            return view('admin.edits.union', [
                'union' => $union,
                'officers' => collect(), // Empty collection
                'notice' => 'No Union Officer role exists yet.',
            ]);
        }
    
        // Fetch officers with the role of "Union Officer"
        $officers = LoanOfficer::where('role_id', $mena->id)
            ->with(['manager.branch']) // Include related manager and branch
            ->get();
    
        // If no officers exist, provide a notice
        $notice = $officers->isEmpty() ? 'No officers have been assigned to the Union Officer role yet.' : null;
    
        // Pass the union, officers, and notice to the view
        return view('admin.edits.union', compact('union', 'officers', 'notice'));
    }
    

    public function update(Request $request, $id)
    {
        $request->validate([
            'union_name' => 'required|string|max:255',
            'union_leader' => 'required|string|max:255',
            'number_of_members' => 'required|integer|min:1',
            'location' => 'required|string|max:255',
            'union_officer' => 'required|exists:loan_officers,id', // Ensure this references the correct table
        ]);
    
        $union = Union::findOrFail($id);
    
        $union->update([
            'union_name' => $request->union_name,
            'union_leader' => $request->union_leader,
            'number_of_members' => $request->number_of_members,
            'location' => $request->location,
            'union_officer' => $request->union_officer,
        ]);
    
        return redirect()->route('adminunion')->with('success', 'Union updated successfully!');
    }


    public function destroy($id)
{
    // Find the union record by its ID
    $union = Union::findOrFail($id);

    // Delete the record
    $union->delete();

    // Redirect back with a success message
    return redirect()->route('adminunion')->with('success', 'Union deleted successfully!');
}
    

    

    // Optionally, show all unions (index)
    public function show($id)
    {
        // Fetch the union with its related officer, manager, and branch
        $union = Union::with(['officer.manager.branch'])->find($id);
        
    
        if (!$union) {
            abort(404, 'Union not found');
        }
    
        
        // Access the officer related to the union (if it exists)
        $officer = $union->officer;
    
        return view('admin.view_union', compact('union', 'officer'));
    }
    
    
    public function addUserToUnion(Request $request)
    {
        try {
            $validated = $request->validate([
                'union_id' => 'required|exists:unions,id',
                'user_id' => 'required|array',
                'user_id.*' => 'exists:users,id', // Ensure each user_id is valid
            ]);
    
            // Loop through user_ids and create the union member record
            foreach ($validated['user_id'] as $user_id) {
                UnionMember::create([
                    'union_id' => $validated['union_id'],
                    'user_id' => $user_id,
                ]);
            }
    
            return response()->json(['success' => true, 'message' => 'Users added to union successfully!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
        }
    }

}
