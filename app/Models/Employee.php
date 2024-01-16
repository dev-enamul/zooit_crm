<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory; 

    protected $fillable = [
        'user_id',
        'reporting_person',
        'employee_position_id',
        'zone_id',
        'area_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function reportingPerson()
    {
        return $this->belongsTo(User::class, 'reporting_person')->withDefault(); 
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class, 'designation_id')->withDefault(); 
    }

    public function zone()
    {
        return $this->belongsTo(Zone::class, 'zone_id')->withDefault();
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }
}
