<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFamily extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'father_name',
        'father_mobile',
        'mother_name',
        'mother_mobile',
        'spouse_name',
        'spouse_contact',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
