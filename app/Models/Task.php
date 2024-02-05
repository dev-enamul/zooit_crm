<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory; 
    protected $fillable = ['assign_to', 'assign_by', 'date', 'submit_time', 'status'];

    public function taskList()
    {
        return $this->hasMany(TaskList::class);
    } 
    
    public function assignee()
    {
        return $this->belongsTo(User::class, 'assign_to');
    }

    public function assigner()
    {
        return $this->belongsTo(User::class, 'assign_by');
    }
}
