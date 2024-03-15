<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory; 
    protected $fillable = [
        'title',
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
}
