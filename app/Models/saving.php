<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class saving extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'amount', 'comment', 'balance'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}
