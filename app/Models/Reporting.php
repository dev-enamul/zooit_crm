<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reporting extends Model
{
   
    use HasFactory;  
    protected $fillable = ['user_id', 
        'reporting_user_id', 
        'change_reason_document', 
        'created_by',
        'updated_by',
        'deleted_by'
    ]; 
    
    public function reportingUser()
    {
        return $this->belongsTo(User::class, 'reporting_user_id');
    }
    
    public function downlines($date = null)
    {
        return $this->hasMany(ReportingUser::class, 'reporting_user_id', 'id')
        ->where('status',1)
        ->whereNull('deleted_at')
        ->select(['id', 'user_id']);
    } 
  
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
