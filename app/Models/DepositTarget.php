<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepositTarget extends Model
{
    use HasFactory;

    protected $fillable = [
        'assign_to',
        'assign_by',
        'is_project_wise',
        'new_deposit',
        'existing_deposit',
    ];

    public function assignTo()
    {
        return $this->belongsTo(User::class, 'assign_to');
    }

    public function assignBy()
    {
        return $this->belongsTo(User::class, 'assign_by');
    }
}
