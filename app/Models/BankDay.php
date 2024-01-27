<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankDay extends Model
{
    use HasFactory;
    protected $fillable =  ['month','bank_day'];
}
