<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
 
        protected $fillable = [
            'user_id',
            'dob',
            'gender',
            'marital_status',
            'tin',
            'phone_number',
            'address',
            'identification_type',
            'id_no',
            'upload',
            'utility_bill',
            'employment_status',
            'job_title',
            'monthly_income',
            'job_duration',
            'bank_name',
            'bank_account_type',
            'account_no',
            'g_name',
            'g_phone',
            'g_address',
            'g_relationship',
            'g_occupation',
            'g_passport',
            'officer',
            'account_type',
        ];
    
    
    
    


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function officer()
{
    return $this->belongsTo(LoanOfficer::class, 'officer', 'id'); // 'officer' is the foreign key
}



}
