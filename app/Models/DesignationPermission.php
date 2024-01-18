<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignationPermission extends Model
{
    use HasFactory; 

    protected $fillable = [
        'designation_id',
        'permission_id', 
    ];
 

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }

    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }
}
