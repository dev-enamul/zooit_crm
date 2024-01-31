<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReportingUser extends Model
{
    use HasFactory,SoftDeletes; 

    protected $fillable = ['user_id','reporting_user_id','created_by','updated_by','deleted_by']; 
    
    public function reportingUser()
    {
        return $this->belongsTo(User::class, 'reporting_user_id');
    }

}
