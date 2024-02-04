<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FreelancerApprovel extends Model
{
    use HasFactory; 

    protected $fillable = [
        'user_id',
        'counselling',
        'interview',
        'meeting_date',
        'training_category_id',
        'remarks',
        'approve_by',
    ];

 
    public function user()
    {
        return $this->belongsTo(User::class);
    }

 
    public function trainingCategory()
    {
        return $this->belongsTo(TrainingCategory::class);
    }
 
    public function approver()
    {
        return $this->belongsTo(User::class, 'approve_by');
    }
}
