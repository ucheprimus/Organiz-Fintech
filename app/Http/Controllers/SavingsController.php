<?php

namespace App\Http\Controllers;

use App\Models\saving;
use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction;
use Illuminate\Support\Facades\Mail;
use App\Mail\TransactionNotification;


class SavingsController extends Controller
{

    public function index()
    {
        $userSavings = User::with(['savings', 'withdrawals'])->get()->map(function ($user) {
            $totalDeposited = $user->savings->sum('amount');  // Total deposits ever made
            $totalWithdrawals = $user->withdrawals->sum('amount');  // Total withdrawn amount
    
            return [
                'id' => $user->id,
                'name' => $user->name,
                'total_savings' => $totalDeposited,  // Total deposits
                'total_withdrawals' => $totalWithdrawals,  // Total withdrawn
                'current_balance' => $totalDeposited - $totalWithdrawals  // Balance (can be negative)
            ];
        });
    
        return view('general.savings', compact('userSavings'));
    }
    

    public function searchUser(Request $request)
    {
        $users = User::where('name', 'like', "%{$request->query}%")
            ->orWhere('email', 'like', "%{$request->query}%")
            ->with([
                'savings' => function ($query) {
                    $query->selectRaw('user_id, SUM(amount) as total_savings')->groupBy('user_id');
                },
                'withdrawals' => function ($query) {
                    $query->selectRaw('user_id, SUM(amount) as total_withdrawals')->groupBy('user_id');
                }
            ])
            ->get()
            ->map(function ($user) {
                $totalSavings = optional($user->savings->first())->total_savings ?? 0;
                $totalWithdrawals = optional($user->withdrawals->first())->total_withdrawals ?? 0;
    
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'balance' => number_format($totalSavings - $totalWithdrawals, 2), // Final balance
                ];
            });
    
        return response()->json($users);
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0',
            'comment' => 'nullable|string|max:255',

        ]);

        try {
            $saving = Saving::create([
                'user_id' => $request->user_id,
                'transaction_type' => 'Savings',
                'amount' => $request->amount,
                'comment' => $request->comment,
                'balance' => $request->amount, // Initialize balance
            ]);

            return redirect()->back()->with('success', 'Savings record added successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }



    public function show($id)
    {
        // Get the user
        $user = User::findOrFail($id);
    
        // Fetch all savings records for the user, ensuring amounts remain unchanged
        $savings = Saving::where('user_id', $id)->get();   

    return view('general.user_savings', compact('user', 'savings'));
}


    // Delete a savings record
    public function destroy(saving $saving)
    {
        $saving->delete();
        return redirect()->back()->with('success', 'Savings record deleted successfully.');
    }

    public function edit($id)
    {
        $saving = saving::findOrFail($id);
        return view('savings.edit', compact('saving'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
        ]);

        $saving = Saving::findOrFail($id);

        // If the balance was previously set, adjust it accordingly
        $difference = $request->amount - $saving->amount;
        $saving->balance += $difference;

        $saving->amount = $request->amount;
        $saving->save();

        return redirect()->back()->with('success', 'Savings record updated successfully.');
    }

    public function withdrawview()
    {
        $withdrawals = Withdrawal::with('user')->latest()->get(); // Fetch all withdrawals
        return view('general.withdrawal', compact('withdrawals'));
    }
    public function fetchBalance(Request $request)
    {
        $user = User::find($request->user_id);

        if (!$user) {
            return response()->json(['balance' => 0.00]);
        }

        // Calculate user's balance dynamically (savings - withdrawals)
        $totalSavings = $user->savings()->sum('amount');
        $totalWithdrawals = $user->withdrawals()->sum('amount'); // Assuming withdrawals are tracked

        $currentBalance = $totalSavings - $totalWithdrawals;

        return response()->json(['balance' => number_format($currentBalance, 2)]);
    }



    public function process(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id', // Ensure user exists
            'amount' => 'required|numeric|min:1',
            'comment' => 'nullable|string|max:255',
        ]);
    
        // Get total savings sum
        $total_savings = Saving::where('user_id', $request->user_id)->sum('amount');
        $total_withdrawals = Withdrawal::where('user_id', $request->user_id)->sum('amount');
    
        $current_balance = $total_savings - $total_withdrawals;
    
        if ($current_balance <= 0) {
            return back()->with('error', 'You have no savings available for withdrawal.');
        }
    
        if ($request->amount > $current_balance) {
            return back()->with('error', 'Not enough balance.');
        }
    
        if (($current_balance - $request->amount) < 1000) {
            return back()->with('error', 'A minimum of ₦1000 must be left in your account.');
        }
    
        // Proceed with withdrawal
        DB::beginTransaction();
        try {
            // Create withdrawal record
            Withdrawal::create([
                'user_id' => $request->user_id,
                'amount' => $request->amount,
                'comment' => $request->comment,
            ]);
    
            DB::commit();
            return back()->with('success', 'Withdrawal successful!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Withdrawal failed. Please try again.');
        }
        
    }
    
    public function viewWithdrawals($userId)
{
    $user = User::find($userId);
    if (!$user) {
        return redirect()->back()->with('error', 'User not found.');
    }

    // Fetch withdrawals instead of savings
    $withdrawals = Withdrawal::where('user_id', $userId)->get();

    return view('general.withdrawals_view', compact('withdrawals', 'user'));
}


public function wupdate(Request $request)
{
    $request->validate([
        'withdrawal_id' => 'required|exists:withdrawals,id',
        'amount' => 'required|numeric|min:1',
        'comment' => 'nullable|string',
    ]);

    $withdrawal = Withdrawal::find($request->withdrawal_id);
    $withdrawal->amount = $request->amount;
    $withdrawal->comment = $request->comment;
    $withdrawal->save();

    return redirect()->back()->with('success', 'Withdrawal updated successfully!');
}

    // Fetch withdrawal history
    public function history($user_id)
    {
        $withdrawals = Withdrawal::where('user_id', $user_id)->orderBy('withdrawn_at', 'desc')->get();
        return view('withdrawals.history', compact('withdrawals'));
    }
}
