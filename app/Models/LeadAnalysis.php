<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeadAnalysis extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'customer_id',
        'hobby',
        'project_id',
        'unit_id',
        'income_range',
        'religion',
        'profession_year',
        'customer_need',
        'tentative_amount',
        'facebook_id',
        'customer_problem',
        'referral',
        'influencer',
        'family_member',
        'decision_maker',
        'previous_experience',
        'instant_investment',
        'buyer',
        'area',
        'consumer',
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
