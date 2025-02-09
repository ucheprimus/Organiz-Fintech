<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanOfficer extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'dob',
        'nationality',
        'phone',
        'email',
        'street_address',
        'city',
        'state',
        'postal_code',
        'ssn',
        'profile_picture',
        'employee_id',
        'role_id',
        'manager_id',
        'branch',
        'date_of_hire',
        'employment_status',
        'employment_type',
        'work_schedule',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function manager()
    {
        return $this->belongsTo(Manager::class, 'manager_id');
    }

    // App\Models\LoanOfficer.php
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch', 'id'); // 'branch' is assumed to store the branch ID
    }

    public function clients()
    {
        return $this->hasMany(Client::class, 'officer', 'id');
    }
    


    
}
