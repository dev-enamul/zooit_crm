<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommissionDeductedSetting extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'start_amount', 
        'end_amount', 
        'deducted',
        'status',
        'created_by', 
        'updated_by', 
        'deleted_by'
    ]; 

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
