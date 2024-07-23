<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [ 'customer_id', 'possible_purchase_date', 'presentation_date', 'remark', 'employee_id', 'approve_by', 'priority', 'status', 'created_by', 'updated_by', 'deleted_by', 'created_at', 'updated_at', 'deleted_at'];

   
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
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
}
