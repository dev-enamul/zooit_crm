<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory; 
    protected $fillable = [
        'category_id',
        'trainer',
        'seat',
        'date',
        'time',
        'agenda',
        'status',
        'created_by'
    ]; 
    
    
    public function attendance()
    {
        return $this->hasMany(TrainingAttendance::class)->where('status', 1);
    }

    public function category()
    {
        return $this->belongsTo(TrainingCategory::class,'category_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class,'created_by');
    }
}
