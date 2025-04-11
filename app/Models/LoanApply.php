<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanApply extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'loan_type_id',
        'loan_amount',
        'interest_rate',
        'loan_duration',
        'repayment_frequency',
        'total_expected_amount',
        'payment_amount',
        'loan_start_date',
        'loan_end_date',
        'collateral',
    ];

    public function loanType()
    {
        return $this->belongsTo(LoanType::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
