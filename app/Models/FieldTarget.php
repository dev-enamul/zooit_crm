<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldTarget extends Model
{
    use HasFactory;
    protected $fillable = [
        'assign_to',
        'assign_by',
        'month',
        'submit_time',
        'freelancer',
        'customer',
        'prospecting',
        'cold_calling',
        'lead',
        'lead_analysis',
        'project_visit',
        'project_visit_analysis',
        'follow_up',
        'follow_up_analysis',
        'negotiation',
        'negotiation_analysis',
    ];
    public function assignTo(){
        return $this->belongsTo(User::class,'assign_to','id');
    }

    public function assignBy(){
        return $this->belongsTo(User::class,'assign_by','id');
    }
}
