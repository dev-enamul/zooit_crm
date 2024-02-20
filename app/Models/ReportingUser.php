<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReportingUser extends Model
{
    use HasFactory,SoftDeletes; 

    protected $fillable = ['user_id','reporting_user_id','change_reason_document','created_by','updated_by','deleted_by']; 
    
    public function reportingUser()
    {
        return $this->belongsTo(User::class, 'reporting_user_id');
    }

    public function downlines($date = null)
    { 
        return $this->hasMany(ReportingUser::class, 'reporting_user_id', 'id')->whereNull('deleted_at')
        ->select(['id', 'user_id']);
    }

    /**
     * Get the user that owns the ReportingUser
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }

}
