<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Freelancer extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'user_id',
        'ref_id',
        'reporting_person',
        'approve_by',
        'last_approve_by',
        'profession_id',
        'designation_id',
        'status', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    } 

    public function profession(){
        return $this->belongsTo(Profession::class,'profession_id');
    }

    public function reference()
    {
        return $this->belongsTo(User::class, 'ref_id')->withDefault(); 
    }

    public function reportingPerson()
    {
        return $this->belongsTo(User::class, 'reporting_person')->withDefault(); 
    }

    public function approveBy()
    {
        return $this->belongsTo(User::class, 'approve_by')->withDefault();
    } 

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }

    public function pending(){
        return $this->where('status',0);
    }
}
