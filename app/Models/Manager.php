<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'branch_id',
        'role_id',
        'start_date',
        'salary',
        'status',
        'password',
    ];

    // Define relationships


    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // Belongs to a single Branch
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }


}
