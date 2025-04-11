<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Define the relationship between the User and the Role models
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }


    /**
     * Check if the user has a specific role
     *
     * @param string $roleName
     * @return bool
     */
    public function hasRole($roleName)
    {
        return $this->roles()->where('name', $roleName)->exists();
    }

    /**
     * Scope to filter users by role name
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $roleName
     * @return \Illuminate\Database\Eloquent\Builder
     */


    public function scopeRole($query, $roleName)
    {
        return $query->whereHas('roles', function ($q) use ($roleName) {
            $q->where('name', $roleName);
        });
    }

    public function client()
    {
        return $this->hasOne(Client::class);
    }



    public function unions()
    {
        return $this->belongsToMany(Union::class, 'union_members', 'user_id', 'union_id');
    }


    public function loans()
    {
        return $this->hasMany(Loan::class);
    }  


    public function savings()
    {
        return $this->hasMany(Saving::class);
    }

public function withdrawals()
{
    return $this->hasMany(Withdrawal::class);
}

    

}
