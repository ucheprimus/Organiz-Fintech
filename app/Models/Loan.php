<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'loan_type', 'loan_amount', 'interest_rate',
        'loan_duration', 'repayment_frequency', 'total_expected_amount', 'loan_start_date', 'loan_end_date', 
        'loan_purpose', 'collateral_type',
    ];
    

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
