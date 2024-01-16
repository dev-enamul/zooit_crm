<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_duration',
        'on_choice_price',
        'lottery_price',
        'project_unit_id',
    ];

    public function projectUnit()
    {
        return $this->belongsTo(ProjectUnit::class, 'project_unit_id');
    }
    
}
