<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpecialCommission extends Model
{
    use HasFactory; 
    use SoftDeletes;

    protected $fillable = ['title', 'status','start_date','end_date', 'created_by', 'updated_by', 'deleted_by'];
 
    public function commissions(){
        return $this->hasMany(Commission::class);
    }

    public function special_commissions(){
        return $this->hasMany(CommissionSpecialCommission::class,'special_commissions_id');
    } 

    public function total_commission(){
        return $this->special_commissions()->sum('commission');
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
