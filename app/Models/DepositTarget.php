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
        'month',
        'is_project_wise',
        'new_total_deposit',
        'existing_total_deposit',
    ];

    public function assignTo()
    {
        return $this->belongsTo(User::class, 'assign_to');
    }

    public function assignBy()
    {
        return $this->belongsTo(User::class, 'assign_by');
    } 

    public function depositTargetProjects()
    {
        return $this->hasMany(DepositTargetProject::class);
    }

    public static function getDepositTarget($user_id, $monthOffset)
    {
        $targetMonth = date('m', strtotime("-$monthOffset month"));
        $targetYear = date('Y'); 
            return self::where('assign_to', $user_id)
            ->whereMonth('month', $targetMonth)
            ->whereYear('month', $targetYear)
            ->selectRaw('SUM(new_total_deposit) + SUM(existing_total_deposit) as total_deposit')
            ->value('total_deposit');
    }
}
