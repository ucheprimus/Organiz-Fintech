<?php

namespace App\Http\Controllers;

use App\Models\Union;
use App\Models\UnionMember;
use App\Models\User;
use Illuminate\Http\Request;

class MembersController extends Controller
{
    //
    public function searchUser(Request $request)
    {
        $query = $request->query('query');

        if (!$query) {
            return response()->json([]);
        }

        $users = User::where('name', 'like', "%$query%")
            ->orWhere('email', 'like', "%$query%")
            ->get(['id', 'name', 'email']); // Fetch id, name, and email

        return response()->json($users);
    }


    public function addUserToUnion(Request $request)
    {
        $request->validate([
            'union_id' => 'required|exists:unions,id', // Make sure the union exists
            'user_id' => 'required|exists:users,id',   // Make sure the user exists
        ]);

        try {
            $union = Union::find($request->union_id); // Find the union by ID
            $user = User::find($request->user_id);    // Find the user by ID

            // Check if user is already a member
            $existingMember = UnionMember::where('union_id', $request->union_id)
                ->where('user_id', $request->user_id)
                ->first();

            if ($existingMember) {
                return response()->json(['success' => false, 'message' => 'User is already added to this union.']);
            }

            // Create the relationship (assuming you have the UnionMember model)
            UnionMember::create([
                'union_id' => $request->union_id,
                'user_id' => $request->user_id,
            ]);

            return response()->json(['success' => true, 'message' => 'User added to the union successfully!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to add user to the union.']);
        }
    }

    // UnionController.php
    public function showMembers($id)
    {
        // Fetch the union and its members
        $union = Union::with('users')->findOrFail($id);

        return view('admin.union', compact('union'));
    }

    public function validateAdminPasswordAndRemove(Request $request)
    {
        $validated = $request->validate([
            'union_id' => 'required|exists:unions,id',
            'user_id' => 'required|exists:users,id',
            'password' => 'required',
        ]);

        // Define the admin password temporarily as a variable
        $adminPassword = 'Hash'; // Replace this with your preferred password

        // Check if the provided password matches the admin password
        if ($validated['password'] !== $adminPassword) {
            return response()->json(['success' => false, 'message' => 'Invalid admin password.']);
        }

        // Remove the user from the union
        $union = Union::findOrFail($validated['union_id']);
        $union->users()->detach($validated['user_id']);

        return response()->json(['success' => true, 'message' => 'User removed from the union.']);
    }
}
