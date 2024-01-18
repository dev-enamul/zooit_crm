<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail; 
use App\Traits\HasPermissionsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasPermissionsTrait; 
    use SoftDeletes; 
    
  protected $fillable = [
        'user_id',
        'name',
        'phone',
        'password',
        'user_type',
        'profile_image',
        'marital_status',
        'dob',
        'finger_id',
        'region',
        'blood_group',
        'gender',
        'professions_id',
        'ref_id',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
 
    protected $hidden = [
        'password',
        'remember_token',
    ];

  
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ]; 

    protected $dates = ['deleted_at'];

    public function profession()
    {
        return $this->belongsTo(Profession::class, 'professions_id');
    }

    public function referee()
    {
        return $this->belongsTo(User::class, 'ref_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }

}
