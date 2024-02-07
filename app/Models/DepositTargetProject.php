<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepositTargetProject extends Model
{
    use HasFactory; 

    protected $fillable = [
        'deposit_target_id',
        'project_id',
        'new_unit',
        'new_deposit',
        'existing_unit',
        'existing_deposit',
    ];

    public function depositTarget()
    {
        return $this->belongsTo(DepositTarget::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
