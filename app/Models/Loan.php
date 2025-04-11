<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'loan_type', 'loan_amount', 'interest_rate',
        'loan_duration', 'repayment_frequency', 'payment_amount', 'total_expected_amount', 'loan_start_date', 'loan_end_date', 
        'loan_purpose', 'collateral_type', 'repayment_amount', 'balance', 'loan_status',
    ];
    

    public function user()
    {
        return $this->belongsTo(User::class);
    }


public function loanType()
{
    return $this->belongsTo(LoanType::class, 'loan_type');
}

public function repayments()
{
    return $this->hasMany(repayment::class);
}

public function getPaidAmountAttribute()
{
    return $this->repayments()->sum('amount');
}

public function getRemainingBalanceAttribute()
{
    return $this->loan_amount - $this->paid_amount;
}

public function getStatusAttribute()
{
    return $this->remaining_balance <= 0 ? 'paid' : 'pending';
}



}
