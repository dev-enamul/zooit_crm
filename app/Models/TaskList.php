<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskList extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id', 'task', 'approve_by', 'status','time',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approve_by');
    }
}
