<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\LoanOfficer;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function client()
    {
        // Fetch the role with the name "Officer"
        $role = Role::where('role_name', 'Officer')->first();

        // Check if the role exists
        if (!$role) {
            // No officers exist, return an empty collection and a notice
            $officers = collect(); // Empty collection
            $notice = 'No officers with the role "Officer" exist yet.';
            return view('general.client', compact('officers', 'notice'));
        }

        // Fetch officers with the role of "Officer"
        $officers = LoanOfficer::where('role_id', $role->id)->get();

        // Fetch all users
        $users = User::all();

        // Fetch all clients and eager load the related user
        $clients = Client::with('user', 'officer')->get();

        // Return the view with all necessary data
        return view('general.client', compact('officers', 'users', 'clients'))
            ->with('debugClients', $clients); // Optional for debugging
    }




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
    




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

     public function store(Request $request)
     {

         try {
             // Validate input
             $validatedData = $request->validate([
                'user_id' => 'required|integer',
                 'dob' => 'nullable|date',
                 'gender' => 'nullable',
                 'marital_status' => 'nullable|string|max:255',
                 'tin' => 'nullable|string|max:255|unique:clients,tin',
                 'phone_number' => 'nullable|string|max:20',
                 'address' => 'nullable|string',
                 'identification_type' => 'nullable|string|max:255',
                 'id_no' => 'nullable|string|max:255',
                 'upload' => 'nullable|file|mimes:jpeg,png,pdf|max:2048',
                 'utility_bill' => 'nullable|file|mimes:jpeg,png,pdf|max:2048',
                 'employment_status' => 'nullable',
                 'job_title' => 'nullable|string|max:255',
                 'monthly_income' => 'nullable|numeric',
                 'job_duration' => 'nullable|integer|min:0',
                 'bank_name' => 'nullable|string|max:255',
                 'account_type' => 'nullable|string|max:255',
                 'account_no' => 'nullable|numeric|digits_between:1,15',
                 'g_name' => 'nullable|string|max:255',
                 'g_phone' => 'nullable|string|max:20',
                 'g_address' => 'nullable|string',
                 'g_relationship' => 'nullable|string|max:255',
                 'g_occupation' => 'nullable|string|max:255',
                 'g_passport' => 'nullable|file|mimes:jpeg,png|max:2048',
                 'officer' => 'required|string|max:255',
                 
             ]);
            //  dd($validatedData);

         } catch (Exception $e) {
             Log::info($e->getMessage());
             return $e->getMessage();
         }
     
         $files = ['upload', 'utility_bill', 'g_passport'];
         foreach ($files as $file) {
             $validatedData[$file] = $request->hasFile($file)
                 ? $request->file($file)->store($file . 's', 'public')
                 : null;
         }
     
         try {
             // Assign user_id before creating the client record
             // Retrieve user using the selected user_id
             $user = User::find($validatedData['user_id']);
             
             // Create Client record
             $client = Client::create([
                 'user_id' => $user->id, // Ensure user_id is passed here
                 'dob' => $validatedData['dob'],
                 'gender' => $validatedData['gender'],
                 'marital_status' => $validatedData['marital_status'],
                 'tin' => $validatedData['tin'],
                 'phone_number' => $validatedData['phone_number'],
                 'address' => $validatedData['address'],
                 'identification_type' => $validatedData['identification_type'],
                 'id_no' => $validatedData['id_no'],
                 'upload' => $validatedData['upload'],
                 'utility_bill' => $validatedData['utility_bill'],
                 'employment_status' => $validatedData['employment_status'],
                 'job_title' => $validatedData['job_title'],
                 'monthly_income' => $validatedData['monthly_income'],
                 'job_duration' => $validatedData['job_duration'],
                 'bank_name' => $validatedData['bank_name'],
                 'account_type' => $validatedData['account_type'],
                 'account_no' => $validatedData['account_no'],
                 'g_name' => $validatedData['g_name'],
                 'g_phone' => $validatedData['g_phone'],
                 'g_address' => $validatedData['g_address'],
                 'g_relationship' => $validatedData['g_relationship'],
                 'g_occupation' => $validatedData['g_occupation'],
                 'g_passport' => $validatedData['g_passport'],
                 'officer' => $validatedData['officer'], // Assign the client to the officer
             ]);
     
             // Redirect or return response
             return redirect()->back()->with('success', 'Client stored successfully.');
         } catch (Exception $es) {
             Log::info($es->getMessage());
             return back()->with('error', $es->getMessage());
         }
     }
     


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
