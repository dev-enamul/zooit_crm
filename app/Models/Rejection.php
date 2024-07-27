<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rejection extends Model
{
    use HasFactory, SoftDeletes; 
    protected $fillable = ['customer_id', 'remark', 'employee_id', 'reject_reason_id', 'customer_price_capability', 'possible_purchase_date', 'competitor_information', 'approve_by', 'status', 'created_by', 'updated_by', 'deleted_by', 'created_at', 'updated_at', 'deleted_at'];
 
    public function reject_reason(){
        return $this->belongsTo(RejectReason::class,'reject_reason_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
 
    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }
 
    public function approver()
    {
        return $this->belongsTo(User::class, 'approve_by');
    }
}
