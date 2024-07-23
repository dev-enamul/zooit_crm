<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'price',
        'description'
    ];

    public function image(){
        $image = $this?->images()?->first()?->name;
        $imagePath = 'public/'.$image;  
        if($image != null && $image != '' && Storage::exists($imagePath)){
           return asset('storage/'.$image);
        }else{
           return asset('../assets/images/users/avatar-6.png');
        }
   } 
    

    public function images()
    {
        return $this->hasMany(ProjectImage::class, 'project_id');
    }  
}
