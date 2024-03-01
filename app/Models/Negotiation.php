<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Negotiation extends Model
{
    use HasFactory, SoftDeletes; 

    protected $fillable = [
        'customer_id',
        'priority',
        'project_id',
        'unit_id',
        'payment_duration',
        'select_type',
        'unit_qty',
        'unit_price',
        'regular_amount',
        'negotiation_amount',
        'remark',
        'date',
        'employee_id',
        'approve_by',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
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
 
    public function approveBy()
    {
        return $this->belongsTo(User::class, 'approve_by');
    }
}
