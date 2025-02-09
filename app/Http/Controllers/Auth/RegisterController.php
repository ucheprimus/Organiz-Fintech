<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration (default registration).
     *
     * @var string
     */
    protected function redirectTo()
    {
        return '/login';  // Default redirect after user registration
    }

    /**
     * Where to redirect clients after registration (custom redirect).
     *
     * @return string
     */
    protected function clientRedirectTo()
    {
        return '/client';  // Custom redirect for clients after registration
    }

    public function account()
    {
        $users = User::all();
        return view('general.account', compact('users'));  // Custom redirect for clients after registration
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration (default).
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * Custom method for client registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function clientCreate(array $data)
    {
        // Handle client-specific registration logic
        // You can create a separate model for client if needed or use User model directly
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            // Add additional client-specific fields if necessary
        ]);
    }

    /**
     * Handle the client registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function registerClient(Request $request)
    {
        // Validate client registration form
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Register the client
        $this->clientCreate($validatedData);

        // Redirect the user to the custom page
        return redirect()->route('account')->with('success', 'Account created successfully.');

    }

    public function editUser($id)
{
    $user = User::findOrFail($id); // Find the user or return 404
    return view('general.edits.user', compact('user')); // Pass the user to the view
}


public function updateUser(Request $request, $id)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $id, // Ignore unique constraint for the current user
    ]);

    $user = User::findOrFail($id);
    $user->update($validatedData);

    return redirect()->route('account')->with('success', 'User updated successfully.');
}


public function deleteUser(Request $request, $id)
{
    // Define the static admin password (this should be securely stored in production)
    $adminPassword = 'Hash'; // Replace with your static password

    // Check if the entered password matches the static admin password
    if ($request->admin_password === $adminPassword) {
        $user = User::findOrFail($id); // Find the user or return 404
        $user->delete(); // Delete the user

        return redirect()->route('account')->with('success', 'User deleted successfully.');
    } else {
        // If the password is incorrect, return an error message
        return redirect()->route('account')->with('error', 'Incorrect administrative password.');
    }
}

}
