<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NegotiationWaitingDay extends Model
{
    use HasFactory; 
    protected $fillable = ['waiting_day'];
}
