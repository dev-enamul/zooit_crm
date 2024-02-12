<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalseReturn extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'customer_id',
        'booking_date',
        'project_id',
        'declaration_value',
        'sold_value',
        'discount_value',
        'total_deposit',
        'due',
        'unit_id',
        'unit_name',
        'unit_facility',
        'on_choice_floor_no',
        'on_choice_unit_no',
        'unit_type',
        'lottery',
        'total_installment',
        'negotiation_type',
        'deduction_amount',
        'sales_return_amount',
        'employee_id',
        'approve_by',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $casts = [
        'booking_date' => 'date',
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

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approve_by');
    }

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }
}
