<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'zone_id',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }
}
