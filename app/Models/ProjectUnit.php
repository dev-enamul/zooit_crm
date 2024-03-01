<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectUnit extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'floor', 'description','sold_status', 'project_id', 'unit_category_id', 'unit_id', 'status', 'created_by', 'updated_by', 'deleted_by'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function unitCategory()
    {
        return $this->belongsTo(UnitCategory::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function unitPrices()
    {
        return $this->hasMany(UnitPrice::class);
    }
}
