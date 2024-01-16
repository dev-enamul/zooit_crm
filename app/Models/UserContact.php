<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserContact extends Model
{
    use HasFactory; 
    protected $fillable = [
        'office_phone',
        'personal_phone',
        'office_email',
        'personal_email',
        'imo_number',
        'facebook_id',
        'user_contactscol',
        'emergency_contact_number',
        'emergency_contact_person',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
