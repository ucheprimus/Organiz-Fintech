<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Union extends Model
{
    use HasFactory;

    // Define the fillable fields
    protected $fillable = [
        'union_name',
        'union_leader',
        'number_of_members',
        'location',
        'union_officer',
        'branch_name',
        'manager_name',
    ];



    public function manager()
    {
        return $this->belongsTo(Manager::class, 'manager_id'); // Assuming 'manager_id' in `users` table
    }

    public function unionOfficer()
    {
        return $this->belongsTo(LoanOfficer::class, 'union_officer');
    }


    public function users()
    {
        return $this->belongsToMany(User::class, 'union_members', 'union_id', 'user_id');
    }



public function members()
{
    return $this->hasMany(UnionMember::class);
}

     // Define the relationship with the Loan Officer
     public function officer()
     {
         return $this->belongsTo(LoanOfficer::class, 'officer_id');
     }
 
     // Define the relationship with the Branch
     public function branch()
     {
         return $this->belongsTo(Branch::class, 'branch_id');
     }
 

}
