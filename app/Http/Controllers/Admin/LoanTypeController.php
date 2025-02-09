<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LoanType;
use Illuminate\Http\Request;

class LoanTypeController extends Controller
{
    //
    public function index()
    {
        $loans = LoanType::all();
        return view('admin.loan_options', compact('loans'));
    }

    // Create loan form
    public function create()
    {
        return view('admin.create_loan');
    }

    // Store loan
    public function store(Request $request)
    {
        $validated = $request->validate([
            'loan_name' => 'required|string|max:255',
            'max_amount' => 'required|numeric',
            'min_amount' => 'required|numeric',
            'interest_rate' => 'required|numeric',
            'status' => 'required|in:active,inactive',
        ]);

        LoanType::create($validated);

        return redirect()->route('loantype')->with('success', 'Loan created successfully');
    }

    // Edit loan form
    public function edit($id)
    {
        $loan = LoanType::findOrFail($id);
        return view('admin.edit_loan', compact('loan'));
    }

    // Update loan
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'loan_name' => 'required|string|max:255',
            'max_amount' => 'required|numeric',
            'min_amount' => 'required|numeric',
            'interest_rate' => 'required|numeric',
            'status' => 'required|in:active,inactive',
        ]);

        $loan = LoanType::findOrFail($id);
        $loan->update($validated);

        return redirect()->route('admin.loan.index')->with('success', 'Loan updated successfully');
    }

    // Delete loan
    public function destroy($id)
    {
        $loan = LoanType::findOrFail($id);
        $loan->delete();

        return redirect()->route('admin.loan.index')->with('success', 'Loan deleted successfully');
    }
}
