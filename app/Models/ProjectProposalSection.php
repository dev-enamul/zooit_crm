<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectProposalSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_proposal_id',
        'title',
        'value',
    ];

    protected $casts = [
        'value' => 'array',
    ];
    

    public function projectProposal()
    {
        return $this->belongsTo(ProjectProposal::class);
    }
}
