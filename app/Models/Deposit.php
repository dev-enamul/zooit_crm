<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'customer_id',
        'deposit_category_id',
        'amount',
        'remark',
        'employee_id',
        'approve_by',
        'created_by',
        'updated_by',
        'deleted_by'
    ];
 
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
 
    public function depositCategory()
    {
        return $this->belongsTo(DepositCategory::class);
    }
 
    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }
 
    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approve_by');
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
}
