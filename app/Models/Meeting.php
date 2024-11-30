<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory; 
    protected $fillable = [
        'customer_id',
        'title',
        'date_time',
        'agenda',
        'status',
        'created_by',
    ];  
    
    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function attendance()
    {
        return $this->hasMany(MeetingAttendance::class);
    }
}
