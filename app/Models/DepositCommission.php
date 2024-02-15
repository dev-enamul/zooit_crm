<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepositCommission extends Model
{
    use HasFactory;

    protected $fillable = [
        'deposit_id',
        'user_id',
        'designation_id', 
        'project_id',
        'commission_id',
        'commission',
        'date',
    ];

    protected $dates = [
        'date',
    ];

    public function deposit()
    {
        return $this->belongsTo(Deposit::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function commission()
    {
        return $this->belongsTo(Commission::class);
    }
}
