<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepositCommission extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'designation_id',
        'salse_id',
        'deposit_id',
        'project_id',
        'commission_id',
        'share_ids',
        'commission_percent',
        'amount',
        'applicable_commission',
        'payble_commission',
        'created_by',
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
