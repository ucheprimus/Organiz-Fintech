<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'comment', 'amount',];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
