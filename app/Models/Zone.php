<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Zone extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name','status', 'created_by', 'updated_by', 'deleted_by'];

    public function areas()
    {
        return $this->hasMany(Area::class, 'zone_id', 'id');
    }
}
