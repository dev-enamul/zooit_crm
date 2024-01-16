<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bank_id',
        'branch',
        'bank_account_number',
        'bank_details',
        'mobile_bank_id',
        'mobile_bank_account_number',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class)->withDefault(); 
    }

    public function mobileBank()
    {
        return $this->belongsTo(Bank::class, 'mobile_bank_id')->withDefault(); 
    }

}
