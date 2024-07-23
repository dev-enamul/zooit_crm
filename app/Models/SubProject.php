<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubProject extends Model
{
    use HasFactory; 
    protected $fillable  = ['project_id', 'name', 'price', 'description', 'status', 'created_at', 'updated_at'];

    public function project(){
        return $this->belongsTo(Project::class);
    }
}
