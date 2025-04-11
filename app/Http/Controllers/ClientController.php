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
use Illuminate\Validation\ValidationException;


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
                'user_id' => 'required|integer|exists:users,id',
                'dob' => 'nullable|date',
                'gender' => 'nullable|string|max:10',
                'marital_status' => 'nullable|string|max:255',
                'tin' => 'nullable|string|max:255|unique:clients,tin',
                'phone_number' => 'nullable|string|max:20',
                'address' => 'nullable|string',
                'identification_type' => 'nullable|string|max:255',
                'id_no' => 'nullable|string|max:255',
                'upload' => 'nullable|file|mimes:jpeg,png,pdf|max:2048',
                'utility_bill' => 'nullable|file|mimes:jpeg,png,pdf|max:2048',
                'employment_status' => 'nullable|string|max:255',
                'job_title' => 'nullable|string|max:255',
                'monthly_income' => 'nullable|numeric',
                'job_duration' => 'nullable|integer|min:0',
                'bank_name' => 'nullable|string|max:255',
                'bank_account_type' => 'nullable|string|max:255',
                'account_no' => 'nullable|numeric|digits_between:1,15',
                'application_range' => 'nullable|string|in:10000-100000,100001-500000,500001-above',
                'g_name' => 'nullable|string|max:255',
                'g_phone' => 'nullable|string|max:20',
                'g_address' => 'nullable|string',
                'g_relationship' => 'nullable|string|max:255',
                'g_occupation' => 'nullable|string|max:255',
                'g_passport' => 'nullable|file|mimes:jpeg,png|max:2048',
                'officer' => 'required|integer|exists:loan_officers,id',

    
                // New: Account type field
                'account_type' => 'required|in:savings,loan,investment',
            ]);
    
        } catch (Exception $e) {
            Log::error("Validation error: " . $e->getMessage());
            return back()->with('error', 'Validation failed. Please check your input.');
        }
    
        // Process file uploads
        $files = ['upload', 'utility_bill', 'g_passport'];
        foreach ($files as $file) {
            $validatedData[$file] = $request->hasFile($file)
                ? $request->file($file)->store($file . 's', 'public')
                : null;
        }
    
        try {
            // Retrieve the selected user
            $user = User::findOrFail($validatedData['user_id']);
            $validatedData = array_map(function ($value) {
                return $value === '' ? null : $value;
            }, $validatedData);
            
    
            // Create a new Client record
            $client = Client::create([
                'user_id' => $user->id,
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
                'bank_account_type' => $validatedData['bank_account_type'],
                'account_no' => $validatedData['account_no'],
                'application_range' => $validatedData['application_range'],

                'g_name' => $validatedData['g_name'],
                'g_phone' => $validatedData['g_phone'],
                'g_address' => $validatedData['g_address'],
                'g_relationship' => $validatedData['g_relationship'],
                'g_occupation' => $validatedData['g_occupation'],
                'g_passport' => $validatedData['g_passport'],
                'officer' => $validatedData['officer'], 
                
                // Store the selected account type
                'account_type' => $validatedData['account_type'],
            ]);
    
            return redirect()->back()->with('success', 'Client stored successfully.');
        } catch (Exception $es) {
            dd($es->getMessage());
        }
        
    }
    

    // public function ssstore(Request $request)
    // {
    //     // Log all incoming request data for debugging purposes
    //     Log::info('Incoming request data:', $request->all());
    
    //     $validatedData = [];
    
    //     try {
    //         // Validate input
    //         $validatedData = $request->validate([
    //             'user_id' => 'required|integer|exists:users,id',
    //             'full_name' => 'required|string|max:255',
    //             'dob' => 'nullable|date',
    //             'gender' => 'nullable|string|max:10',
    //             'marital_status' => 'nullable|string|max:255',
    //             'tin' => 'nullable|string|max:255|unique:clients,tin',
    //             'phone_number' => 'nullable|string|max:20',
    //             'address' => 'nullable|string',
    //             'identification_type' => 'nullable|string|max:255',
    //             'id_no' => 'nullable|string|max:255',
    //             'upload' => 'nullable|file|mimes:jpeg,png,pdf|max:2048',
    //             'utility_bill' => 'nullable|file|mimes:jpeg,png,pdf|max:2048',
    //             'employment_status' => 'nullable|string|max:255',
    //             'job_title' => 'nullable|string|max:255',
    //             'monthly_income' => 'nullable|numeric',
    //             'job_duration' => 'nullable|integer|min:0',
    //             'bank_name' => 'nullable|string|max:255',
    //             'bank_account_type' => 'nullable|string|max:255',
    //             'account_no' => 'nullable|numeric|digits_between:1,15',
    //             'application_range' => 'nullable|string|in:10000-100000,100001-500000,500001-above',
    //             'g_name' => 'nullable|string|max:255',
    //             'g_phone' => 'nullable|string|max:20',
    //             'g_address' => 'nullable|string',
    //             'g_relationship' => 'nullable|string|max:255',
    //             'g_occupation' => 'nullable|string|max:255',
    //             'g_passport' => 'nullable|file|mimes:jpeg,png|max:2048',
    //             'officer' => in_array(Auth::user()->role, ['admin', 'manager']) 
    //             ? 'required|string|max:255' 
    //             : 'nullable|string|max:255',
    //             'account_type' => 'required|in:savings,loan,investment',
    //         ]);
    //     } catch (ValidationException $e) {
    //         // Log validation errors
    //         Log::error('Validation failed: ', $e->errors());
    
    //         return back()
    //             ->withErrors($e->errors()) // Show form errors
    //             ->withInput() // Refill form values
    //             ->with('error', 'Validation failed. Please check your input.');
    //     }
    
    //     // Handle file uploads
    //     $files = ['upload', 'utility_bill', 'g_passport'];
    //     foreach ($files as $file) {
    //         if ($request->hasFile($file)) {
    //             $validatedData[$file] = $request->file($file)->store("uploads/$file", 'public');
    //         } else {
    //             $validatedData[$file] = null;
    //         }
    //     }
    
    //     // Log validated data before performing DB operations
    //     Log::info('Validated data before DB operation:', $validatedData);
    
    //     try {
    //         // Log the user search operation
    //         Log::info('Searching for user by ID: ' . $validatedData['user_id']);
    //         $user = User::findOrFail($validatedData['user_id']);
    
    //         // Log the found user
    //         Log::info('User found:', ['user' => $user]);
    
    //         // Save client data
    //         $client = Client::create([
    //             'full_name' => $validatedData['full_name'], // <-- Add this line
    //             'user_id' => $user->id,
    //             'dob' => $validatedData['dob'],
    //             'gender' => $validatedData['gender'],
    //             'marital_status' => $validatedData['marital_status'],
    //             'tin' => $validatedData['tin'],
    //             'phone_number' => $validatedData['phone_number'],
    //             'address' => $validatedData['address'],
    //             'identification_type' => $validatedData['identification_type'],
    //             'id_no' => $validatedData['id_no'],
    //             'upload' => $validatedData['upload'],
    //             'utility_bill' => $validatedData['utility_bill'],
    //             'employment_status' => $validatedData['employment_status'],
    //             'job_title' => $validatedData['job_title'],
    //             'monthly_income' => $validatedData['monthly_income'],
    //             'job_duration' => $validatedData['job_duration'],
    //             'bank_name' => $validatedData['bank_name'],
    //             'bank_account_type' => $validatedData['bank_account_type'],
    //             'account_no' => $validatedData['account_no'],
    //             'application_range' => $validatedData['application_range'],
    //             'g_name' => $validatedData['g_name'],
    //             'g_phone' => $validatedData['g_phone'],
    //             'g_address' => $validatedData['g_address'],
    //             'g_relationship' => $validatedData['g_relationship'],
    //             'g_occupation' => $validatedData['g_occupation'],
    //             'g_passport' => $validatedData['g_passport'],
    //             'officer' => $validatedData['officer'],
    //             'account_type' => $validatedData['account_type'],
    //         ]);
    
    //         // Log successful client creation
    //         Log::info('Client created successfully:', ['client' => $client]);
    
    //         return redirect()->back()->with('success', 'Client stored successfully.');
    //     } catch (\Exception $es) {
    //         // Log detailed exception information
    //         Log::error("Client creation error: " . $es->getMessage(), [
    //             'file' => $es->getFile(),
    //             'line' => $es->getLine(),
    //             'trace' => $es->getTraceAsString(),
    //             'validated_data' => $validatedData, // Log the validated data as well
    //         ]);
    
    //         return back()->with('error', 'Failed to store client.');
    //     }
    // }
    
    

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
