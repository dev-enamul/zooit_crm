<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommissionSpecialCommission extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'commissions_id', 'special_commissions_id', 'commission',
        'created_by', 'updated_by', 'deleted_by'
    ];

    // Define the commission and special_commission relationships
    public function commission()
    {
        return $this->belongsTo(Commission::class, 'commissions_id');
    }

    public function specialCommission()
    {
        return $this->belongsTo(SpecialCommission::class, 'special_commissions_id');
    }
 
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }
}
