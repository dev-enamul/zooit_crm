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
        'slug',
        'sales_by',
        'currency',
        'price',
        'paid',
        'submit_date',
        'project_status',
        'status',
        'remark',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($project) {
            if (empty($project->slug) && !empty($project->title)) {
                $project->slug = getSlug(Project::class, $project->title);
            }
        });

        static::updating(function ($project) {
            if ($project->isDirty('title') && !empty($project->title)) {
                // Generate slug based on new title, excluding current project
                $slug = \Illuminate\Support\Str::slug($project->title);
                $originalSlug = $slug;
                $count = 1;

                while (Project::where('slug', $slug)->where('id', '!=', $project->id)->exists()) {
                    $slug = $originalSlug . '-' . $count;
                    $count++;
                }

                $project->slug = $slug;
            }
        });
    }

 
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

    public function workTimes()
    {
        return $this->hasMany(WorkTime::class, 'project_id');
    }


}
