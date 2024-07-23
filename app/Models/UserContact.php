<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserContact extends Model
{
    use HasFactory; 
    protected $fillable = ['user_id', 'type', 'designation_id', 'name', 'gender', 'religion', 'dob', 'phone', 'personal_phone', 'email', 'personal_email', 'imo_number', 'facebook_id', 'linkedin_id', 'twiter_id', 'instragram_id', 'created_at', 'updated_at'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
