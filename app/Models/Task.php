<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory; 
    protected $fillable = [
        'project_id',
        'title',
        'description',
        'priority',
        'estimated_time',
        'time_spent',
        'assign_to',
        'assign_by',
        'submit_time',
        'status',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assign_to');
    }

    public function assignedBy()
    {
        return $this->belongsTo(User::class, 'assign_by');
    }



}
