<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;


    protected $fillable = [
       'role_name'
    ];


    // A role has many managers
    public function managers()
    {
        return $this->hasMany(Manager::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user', 'role_id', 'user_id');
    }

}
