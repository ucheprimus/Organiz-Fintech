<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\LoanType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


class LoanController extends Controller
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


    public function index(Request $request)
    {

        // Assuming you are fetching all loan types
        $loanTypes = LoanType::all();

        // If the form is already submitted and a loan type is selected
        $interestRate = null;
        if ($request->has('loanType')) {
            $loanType = LoanType::find($request->loanType);
            $interestRate = $loanType ? $loanType->interest_rate : null;
        }

        return view('general.loan', compact('loanTypes', 'interestRate'));
    }


//     public function store(Request $request)
// {
//     try {
//         // Fetch the selected loan type
//         $loanType = LoanType::find($request->loanType);

//         if (!$loanType) {
//             return redirect()->back()->withErrors(['loanType' => 'Invalid loan type selected'])->withInput();
//         }

//         // Custom validation rules
//         $validator = Validator::make($request->all(), [
//             'loanAmount' => [
//                 'required',
//                 'numeric',
//                 function ($attribute, $value, $fail) use ($loanType) {
//                     if ($value < $loanType->min_amount || $value > $loanType->max_amount) {
//                         $fail("The loan amount must be between {$loanType->min_amount} and {$loanType->max_amount}.");
//                     }
//                 },
//             ],
//             'loanType' => 'required|exists:loan_types,id',
//             'loanDuration' => 'required|integer',
//             'loanStartDate' => 'required|date',
//             'loanEndDate' => 'required|date|after:loanStartDate',
//             'loanPurpose' => 'nullable|string',
//             'collateralType' => 'nullable|string',
//         ]);

//         if ($validator->fails()) {
//             return redirect()->back()->withErrors($validator)->withInput();
//         }

//         // Fetch the user using the search query
//         $user = User::where('id', $request->user_id)->first();

//         if (!$user) {
//             return redirect()->back()->withErrors(['user' => 'Invalid user selected'])->withInput();
//         }

//         // Save loan details, associating the loan with the user via user_id
//         Loan::create([
//             'user_id' => $user->id, // Use the user_id here, not user_name
//             'loan_type_id' => $loanType->id,
//             'loan_amount' => $request->loanAmount,
//             'interest_rate' => $loanType->interest_rate,
//             'loan_duration' => $request->loanDuration,
//             'loan_start_date' => $request->loanStartDate,
//             'loan_end_date' => $request->loanEndDate,
//             'loan_purpose' => $request->loanPurpose,
//             'collateral_type' => $request->collateralType,
//         ]);

//         return redirect()->route('general.loan')->with('success', 'Loan application submitted successfully.');
//     } catch (\Exception $e) {
//         // Log the error for debugging
//         Log::error('Error storing loan application: ' . $e->getMessage());

//         // Return an error message to the user
//         return redirect()->back()->with('error', 'An unexpected error occurred. Please try again.');
//     }
// }


// public function store(Request $request)
//     {
//         // Validation
//         $validator = Validator::make($request->all(), [
//             'user_id' => 'required|exists:users,id',
//             'loanType' => 'required|exists:loan_types,id',
//             'loanAmount' => 'required|numeric|min:1000',
//             'interestRate' => 'required|numeric|min:0|max:100',
//             'loanDuration' => 'required|integer|min:1',
//             'loanStartDate' => 'required|date',
//             'loanEndDate' => 'required|date|after:loanStartDate',
//             'loanPurpose' => 'nullable|string|max:255',
//             'collateralType' => 'nullable|string|max:255',
//             'repaymentFrequency' => 'required|in:Weekly,Monthly,Twice_a_month,Quarterly,Annually',
//         ]);

//         if ($validator->fails()) {
//             return back()->withErrors($validator)->withInput();
//         }

//         // Calculate Total Expected Amount and Payment Amount
//         $loanAmount = $request->loanAmount;
//         $interestRate = $request->interestRate;
//         $totalExpectedAmount = $loanAmount + ($loanAmount * $interestRate / 100);

//         // Determine Number of Installments Based on Repayment Frequency
//         $installments = match ($request->repaymentFrequency) {
//             'Weekly' => $request->loanDuration * 4,
//             'Monthly' => $request->loanDuration,
//             'Twice_a_month' => $request->loanDuration * 2,
//             'Quarterly' => $request->loanDuration / 3,
//             'Annually' => $request->loanDuration / 12,
//             default => 1,
//         };

//         $paymentAmount = $installments > 0 ? $totalExpectedAmount / $installments : $totalExpectedAmount;

//         // Store Loan Data
//         Loan::create([
//             'user_id' => $request->user_id,
//             'loan_type' => $request->loanType,
//             'loan_amount' => $loanAmount,
//             'interest_rate' => $interestRate,
//             'loan_duration' => $request->loanDuration,
//             'loan_start_date' => $request->loanStartDate,
//             'loan_end_date' => $request->loanEndDate,
//             'loan_purpose' => $request->loanPurpose,
//             'collateral_type' => $request->collateralType,
//             'repayment_frequency' => $request->repaymentFrequency,
//             'total_expected_amount' => $totalExpectedAmount,
//             'payment_amount' => $paymentAmount,
//         ]);

//         return redirect()->route('loan.index')->with('success', 'Loan application successfully created.');
//     }

// }


public function store(Request $request)
    {
        // Validate form inputs
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'loanType' => 'required|exists:loan_types,id',
            'loanAmount' => 'required|numeric|min:1',
            'interestRate' => 'required|numeric|min:0',
            'loanDuration' => 'required|numeric|min:1',
            'repaymentFrequency' => 'required|string',
            'loanStartDate' => 'required|date',
            'loanEndDate' => 'required|date|after_or_equal:loanStartDate',
            'loanPurpose' => 'nullable|string|max:255',
            'collateralType' => 'nullable|string|max:255',
        ]);

        try {
            // Calculate total expected amount and payment amount if needed
            $interestRate = $validatedData['interestRate'] / 100;
            $loanAmount = $validatedData['loanAmount'];
            $totalInterest = $loanAmount * $interestRate;
            $totalExpectedAmount = $loanAmount + $totalInterest;

            // Store the loan in the database
            $loan = new Loan();
            $loan->user_id = $validatedData['user_id'];
            $loan->loan_type_id = $validatedData['loanType'];
            $loan->loan_amount = $loanAmount;
            $loan->interest_rate = $validatedData['interestRate'];
            $loan->loan_duration = $validatedData['loanDuration'];
            $loan->repayment_frequency = $validatedData['repaymentFrequency'];
            $loan->loan_start_date = $validatedData['loanStartDate'];
            $loan->loan_end_date = $validatedData['loanEndDate'];
            $loan->loan_purpose = $validatedData['loanPurpose'];
            $loan->collateral_type = $validatedData['collateralType'];
            $loan->total_expected_amount = $totalExpectedAmount;
            $loan->save();

            // Redirect with success notification
            return redirect()->back()->with('success', 'Loan application submitted successfully.');
        } catch (\Exception $e) {
            // Handle unexpected errors
            return redirect()->back()->withErrors('An error occurred: ' . $e->getMessage());
        }
    }
}