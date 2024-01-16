<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes; 

    protected $fillable = [
        'employee_id',
        'user_id',
        'reporting_id',
        'reporting_person_id',
        'designation_id',
        'zone_id',
        'area_id',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reportingPerson()
    {
        return $this->belongsTo(Employee::class, 'reporting_person_id');
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }

    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }
 
}
