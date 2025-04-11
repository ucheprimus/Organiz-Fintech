<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\LoanType;
use App\Models\repayment;
use App\Models\saving;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\Transaction;
use Illuminate\Support\Facades\Mail;
use App\Mail\TransactionNotification;
use App\Models\Client;
use App\Models\LoanApply;
use App\Models\LoanOfficer;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;



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


    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'loan_type' => 'required|exists:loan_types,id',
            'loan_amount' => 'required|numeric|min:1',
            'interest_rate' => 'required|numeric',
            'loan_duration' => 'required|numeric|min:1',
            'repayment_frequency' => 'required',
            'loan_start_date' => 'required|date',
            'loan_end_date' => 'required|date|after:loan_start_date',
        ]);

        $userId = $request->user_id;
        $loanTypeId = $request->loan_type;

        // Count active loans of the same type for this user


        // Count active loans of the same type for this user, excluding fully settled loans
        $activeLoans = Loan::where('user_id', $userId)
            ->where('loan_type', $loanTypeId)
            ->where(function ($query) {
                $query->where('loan_status', '!=', 'Fully Paid')  // Exclude fully paid loans
                    ->where('balance', '>', 0);                // Only count loans with remaining balance
            })
            ->count();




        // $activeLoans = Loan::where('user_id', $userId)
        //     ->where('loan_type', $loanTypeId)
        //     ->where('loan_status', '!=', 'Fully Paid') // Checking loans that are not fully repaid
        //     ->count();

        // Allow up to 2 active loans of the same type
        if ($activeLoans >= 2) {
            return back()->with('error', 'You cannot take more than 2 active loans of the same type unless one is fully paid.');
        }

        // Determine loan status based on dates and payments
        $loan_status = 'Active'; // Default status
        $balance = $request->loan_amount; // Initial balance is the loan amount

        if (now()->greaterThan($request->loan_end_date) && $balance > 0) {
            $loan_status = 'Overdue';
        }

        // Create the loan if within the limit
        Loan::create([
            'user_id' => $userId,
            'loan_type' => $loanTypeId,
            'loan_amount' => $request->loan_amount,
            'interest_rate' => $request->interest_rate,
            'loan_duration' => $request->loan_duration,
            'repayment_frequency' => $request->repayment_frequency,
            'total_expected_amount' => $request->total_expected_amount,
            'payment_amount' => $request->payment_amount,
            'loan_start_date' => $request->loan_start_date,
            'loan_end_date' => $request->loan_end_date,
            'loan_purpose' => $request->loan_purpose,
            'collateral_type' => $request->collateral_type,
            'repayment_amount' => 0,
            'balance' => $balance,
            'loan_status' => $loan_status,
        ]);

        return back()->with('success', 'Loan application submitted successfully.');
    }




    public function view()
    {
        return view('general.view_loan');
    }


    public function weekly()
    {
        $loanType = LoanType::whereRaw('LOWER(loan_name) = ?', ['Weekly Loan'])->first();


        if (!$loanType) {
            return back()->with('error', 'Loan type "Weekly Loan" not found.');
        }

        // Fetch all loans related to the "Monthly Loan" type
        $loans = Loan::with(['user', 'loanType', 'repayments'])
            ->where('loan_type', $loanType->id)
            ->get()
            ->map(function ($loan) {
                // Calculate total repayments
                $loan->repayment_amount = $loan->repayments->sum('amount');

                // Calculate balance dynamically
                $loan->balance = $loan->total_expected_amount - $loan->repayment_amount;

                return $loan;
            });

        // Separate loans into categories
        $activeLoans = $loans->filter(fn($loan) => $loan->balance > 0 && now()->lessThanOrEqualTo($loan->loan_end_date));
        $settledLoans = $loans->filter(fn($loan) => $loan->balance == 0);
        $overdueLoans = $loans->filter(fn($loan) => $loan->balance > 0 && now()->greaterThan($loan->loan_end_date));


        // Get counts
        $totalLoans = $loans->count();
        $activeCount = $activeLoans->count();
        $settledCount = $settledLoans->count();
        $overdueCount = $overdueLoans->count();

        return view('general.monthly_loan', compact('activeLoans', 'settledLoans', 'overdueLoans', 'totalLoans', 'activeCount', 'settledCount', 'overdueCount'));
    }


    public function getLoanDetails($loan_id)
    {
        $loan = Loan::find($loan_id);
        $total_expected = $loan->total_expected_amount; // Total to be paid
        $total_repaid = Repayment::where('loan_id', $loan->id)->sum('amount'); // Total repaid
        $balance = $total_expected - $total_repaid; // Remaining balance

        return response()->json([
            'total_expected' => $total_expected,
            'total_repaid' => $total_repaid,
            'balance' => $balance,
        ]);
    }



    public function repay(Request $request, $id)
    {
        $loan = Loan::findOrFail($id);

        // Update repayment amount
        $loan->repayment_amount += $request->repayment_amount;

        // Update balance
        $loan->balance = $loan->total_expected_amount - $loan->repayment_amount;

        // Save changes
        $loan->save();

        return redirect()->back()->with('success', 'Repayment successful');
    }


    public function repayment()
    {
        $users = User::whereHas('loans', function ($query) {
            $query->where('balance', '>', 0); // Only get users who have unpaid loans
        })->get();


        return view('general.repayment', compact('users'));
    }


    public function fetchLoans(Request $request)
    {
        $user_id = $request->user_id;

        $loans = Loan::where('user_id', $user_id)
            ->with('loanType') // Ensure we load the loan type relationship
            ->get();

        return response()->json($loans);
    }

    public function processTransaction(Request $request)
    {
        Log::info('Processing Transaction', $request->all()); // Debugging log

        // Validation
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'loan_id' => 'nullable|exists:loans,id',
            'loan_amount' => 'nullable|numeric|min:0',
            'savings_amount' => 'nullable|numeric|min:0',
        ]);

        // Process Loan Repayment if amount is greater than 0
        if ($request->loan_id && $request->loan_amount > 0) {
            $loan = Loan::findOrFail($request->loan_id);

            // Check if loan is fully paid
            if ($loan->balance <= 0) {
                return back()->with('error', 'This loan is already fully paid.');
            }

            // Update repayment amount
            $loan->repayment_amount += $request->loan_amount;

            // Deduct repayment from balance
            $loan->balance = $loan->total_expected_amount - $loan->repayment_amount;

            // Ensure balance doesn't go negative
            if ($loan->balance < 0) {
                $loan->balance = 0;
            }

            // Save updated loan
            $loan->save();

            // Save repayment record
            Repayment::create([
                'user_id' => $request->user_id,
                'loan_id' => $request->loan_id,
                'amount' => $request->loan_amount,
                'paid_at' => now(),
            ]);
        }

        // Process Savings if amount is greater than 0
        if ($request->savings_amount > 0) {
            Saving::create([
                'user_id' => $request->user_id,
                'amount' => $request->savings_amount,
                'date' => now()->toDateString(),
                'saved_at' => now(),
            ]);
        }

        return back()->with('success', 'Transaction processed successfully.');
    }


    public function monthly()
    {
        $loanType = LoanType::whereRaw('LOWER(loan_name) = ?', ['Monthly Loan'])->first();


        if (!$loanType) {
            return back()->with('error', 'Loan type "Monthly Loan" not found.');
        }

        // Fetch all loans related to the "Monthly Loan" type
        $loans = Loan::with(['user', 'loanType', 'repayments'])
            ->where('loan_type', $loanType->id)
            ->get()
            ->map(function ($loan) {
                // Calculate total repayments
                $loan->repayment_amount = $loan->repayments->sum('amount');

                // Calculate balance dynamically
                $loan->balance = $loan->total_expected_amount - $loan->repayment_amount;

                return $loan;
            });

        // Separate loans into categories
        $activeLoans = $loans->filter(fn($loan) => $loan->balance > 0 && now()->lessThanOrEqualTo($loan->loan_end_date));
        $settledLoans = $loans->filter(fn($loan) => $loan->balance == 0);
        $overdueLoans = $loans->filter(fn($loan) => $loan->balance > 0 && now()->greaterThan($loan->loan_end_date));


        // Get counts
        $totalLoans = $loans->count();
        $activeCount = $activeLoans->count();
        $settledCount = $settledLoans->count();
        $overdueCount = $overdueLoans->count();

        return view('general.monthly_loan', compact('activeLoans', 'settledLoans', 'overdueLoans', 'totalLoans', 'activeCount', 'settledCount', 'overdueCount'));
    }

    public function assets()
    {
        $loanType = LoanType::whereRaw('LOWER(loan_name) = ?', ['assets loan'])->first();


        if (!$loanType) {
            return back()->with('error', 'Loan type "Assets Loan" not found.');
        }

        // Fetch all loans related to the "Monthly Loan" type
        $loans = Loan::with(['user', 'loanType', 'repayments'])
            ->where('loan_type', $loanType->id)
            ->get()
            ->map(function ($loan) {
                // Calculate total repayments
                $loan->repayment_amount = $loan->repayments->sum('amount');

                // Calculate balance dynamically
                $loan->balance = $loan->total_expected_amount - $loan->repayment_amount;

                return $loan;
            });

        // Separate loans into categories
        $activeLoans = $loans->filter(fn($loan) => $loan->balance > 0 && now()->lessThanOrEqualTo($loan->loan_end_date));
        $settledLoans = $loans->filter(fn($loan) => $loan->balance == 0);
        $overdueLoans = $loans->filter(fn($loan) => $loan->balance > 0 && now()->greaterThan($loan->loan_end_date));


        // Get counts
        $totalLoans = $loans->count();
        $activeCount = $activeLoans->count();
        $settledCount = $settledLoans->count();
        $overdueCount = $overdueLoans->count();

        return view('general.assets_loan', compact('activeLoans', 'settledLoans', 'overdueLoans', 'totalLoans', 'activeCount', 'settledCount', 'overdueCount'));
    }








    //// normal user side ///



    public function loan_apply(Request $request)
    {
        $userId = Auth::id();

        // Fetch loan types
        $loanTypes = LoanType::all();

        $interestRate = null;
        $selectedLoanTypeId = $request->loanType;

        if ($selectedLoanTypeId) {
            $loanType = LoanType::find($selectedLoanTypeId);
            $interestRate = $loanType ? $loanType->interest_rate : null;
        }

        // 1. Check if bio-data is completed
        $client = Client::where('user_id', $userId)->first();
        if (!$client) {
            return redirect()->back()->with('error', 'You are not eligible to apply for a loan. Please complete your bio-data first.');
        }

        // 2. Optional: check if user is trying to reapply for same loan type before repaying 75%
        if ($selectedLoanTypeId) {
            $existingLoan = Loan::where('user_id', $userId)
                ->where('loan_type_id', $selectedLoanTypeId)
                ->where('status', 'approved')
                ->latest()
                ->first();

            if ($existingLoan) {
                $amountPaid = $existingLoan->amount_paid ?? 0;
                $totalAmount = $existingLoan->total_amount ?? 1;
                $percentagePaid = ($amountPaid / $totalAmount) * 100;

                if ($percentagePaid < 75) {
                    return redirect()->back()->with('error', 'You already have a loan of this type. You must repay at least 75% before applying again.');
                }
            }
        }

        return view('loan_apply', compact('loanTypes', 'interestRate'));
    }



    public function apply(Request $request)
    {
        $validated = $request->validate([
            'loan_type' => 'required|exists:loan_types,id',
            'loan_amount' => 'required|numeric|min:1',
            'interest_rate' => 'required|numeric|min:0',
            'loan_duration' => 'required|integer|min:1',
            'repayment_frequency' => 'required|string',
            'total_expected_amount' => 'required|numeric',
            'payment_amount' => 'required|numeric',
            'loan_start_date' => 'required|date',
            'loan_end_date' => 'required|date|after_or_equal:loan_start_date',
            'collateral' => 'nullable|string|max:255',
        ]);

        $apply = LoanApply::create([
            'user_id' => Auth::id(),
            'loan_type_id' => $validated['loan_type'],
            'loan_amount' => $validated['loan_amount'],
            'interest_rate' => $validated['interest_rate'],
            'loan_duration' => $validated['loan_duration'],
            'repayment_frequency' => $validated['repayment_frequency'],
            'total_expected_amount' => $validated['total_expected_amount'],
            'payment_amount' => $validated['payment_amount'],
            'loan_start_date' => $validated['loan_start_date'],
            'loan_end_date' => $validated['loan_end_date'],
            'collateral' => $validated['collateral'] ?? null,
        ]);

        return redirect()->back()->with('success', 'Loan application submitted successfully!');
    }


    public function bio_data()
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

        return view('bio_data', compact('officers'));
    }
}
