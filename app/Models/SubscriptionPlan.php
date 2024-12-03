<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPlan extends Model
{
    use HasFactory; 
    protected $fillable = [
        'user_id',
        'customer_id',
        'project_id',
        'reason',
        'package_type',
        'amount',
        'next_payment_date',
        'remark',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    } 
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    } 
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

}
