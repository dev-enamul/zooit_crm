<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserId extends Model
{
    use HasFactory; 

    protected $fillable = [
        'user_id',
        'nid_number',
        'nid_image',
        'birth_cirtificate_number',
        'birth_cirtificate_image',
        'passport_number',
        'passport_image',
        'passport_issue_date',
        'passport_exp_date',
        'tin_number',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
