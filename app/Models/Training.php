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
    ]; 
    
    
    public function attendance()
    {
        return $this->hasMany(TrainingAttendance::class)->where('status', 1);
    }

    public function category()
    {
        return $this->belongsTo(TrainingCategory::class,'category_id');
    }
}
