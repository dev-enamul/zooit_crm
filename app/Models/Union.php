<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Union extends Model
{
    use HasFactory;  

    protected $fillable = ['upazila_id', 'name', 'bn_name', 'url', 'status', 'created_by', 'updated_by', 'deleted_by'];

    public function upazilla()
    {
        return $this->belongsTo(Upazila::class, 'upazila_id');
    }
}
