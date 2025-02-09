<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_name',
        'branch_location',
        'branch_code'        
    ];

    // Define the one-to-one relationship with Manager
  // One-to-One relationship with Manager
  public function manager()
  {
      return $this->hasOne(Manager::class, 'branch_id', 'id');
  }
}
