<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Project extends Model
{
    use HasFactory, SoftDeletes; 

     protected $fillable = [
        'customer_id',
        'project_proposal_id',
        'team_leader_id',
        'title',
        'sales_by',
        'currency',
        'price',
        'paid',
        'submit_date',
        'project_status',
        'status',
        'remark',
    ];

 
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
 
    public function proposal()
    {
        return $this->belongsTo(ProjectProposal::class, 'project_proposal_id');
    }
 
    public function teamLeader()
    {
        return $this->belongsTo(User::class, 'team_leader_id');
    }
 
    public function salesBy()
    {
        return $this->belongsTo(User::class, 'sales_by');
    }
 
    public function projectTeams()
    {
        return $this->hasMany(ProjectTeam::class, 'project_id');
    }
 
    public function tasks()
    {
        return $this->hasMany(Task::class, 'project_id');
    }

}
