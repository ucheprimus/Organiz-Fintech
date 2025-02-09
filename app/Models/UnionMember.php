<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnionMember extends Model
{
    use HasFactory;
    protected $fillable = [
        'union_id',
        'user_id',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function union()
    {
        return $this->belongsTo(Union::class, 'union_id');
    }
}
