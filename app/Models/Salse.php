<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Salse extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'customer_id',
        'project_id',
        'unit_id',
        'payment_duration',
        'select_type',
        'project_units',
        'regular_amount',
        'sold_value',
        'down_payment',
        'down_payment_pay',
        'rest_down_payment_date',
        'installment_type',
        'installment_value',
        'facility',
        'employee_id',
        'approve_by',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $casts = [
        'project_units' => 'json', 
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approve_by');
    }
}
