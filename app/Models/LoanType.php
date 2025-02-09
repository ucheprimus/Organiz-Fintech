<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanType extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_name',
        'max_amount',
        'min_amount',
        'interest_rate',
        'status',
    ];
}
