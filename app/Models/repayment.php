<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class repayment extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'loan_id', 'amount', 'payment_date'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }

    
}
