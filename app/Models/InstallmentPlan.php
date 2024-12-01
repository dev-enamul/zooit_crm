<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstallmentPlan extends Model
{
    use HasFactory;  
    protected $fillable = [
        'customer_id',
        'project_id',
        'payment_date',
        'amount',
        'is_invoiced',
    ];  

}
