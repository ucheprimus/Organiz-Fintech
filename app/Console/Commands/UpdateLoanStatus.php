<?php

namespace App\Console\Commands;

use App\Models\Loan;
use Illuminate\Console\Command;
use Carbon\Carbon;

class UpdateLoanStatus extends Command
{
    protected $signature = 'update:loan-status';
    protected $description = 'Update loan statuses based on repayment and due dates';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Get all active loans that have not been fully paid
        $loans = Loan::where('loan_status', '!=', 'Fully Paid')->get();

        foreach ($loans as $loan) {
            // Check if the loan is overdue
            if (Carbon::now()->greaterThan($loan->loan_end_date) && $loan->balance > 0) {
                $loan->loan_status = 'Overdue';
            }

            // Check if the loan is fully paid
            if ($loan->balance <= 0) {
                $loan->loan_status = 'Fully Paid';
            }

            $loan->save();
        }

        $this->info('Loan statuses updated successfully.');
    }
}
