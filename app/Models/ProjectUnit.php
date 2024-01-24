<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectUnit extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'floor', 'description', 'project_id', 'unit_category_id', 'unit_id', 'status', 'created_by', 'updated_by', 'deleted_by'];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function unitCategory()
    {
        return $this->belongsTo(UnitCategory::class, 'unit_category_id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
}
