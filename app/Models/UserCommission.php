<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCommission extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','total_regular_commission','total_special_commission', 'total_commission', 'paid_commission', 'pending_commission'];
}
