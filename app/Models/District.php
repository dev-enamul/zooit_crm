<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class District extends Model
{
    use HasFactory;

    protected $fillable = ['division_id', 'name', 'bn_name', 'lat', 'lon', 'url'];
 
    public function division()
    {
        return $this->belongsTo(Division::class);
    }
}
