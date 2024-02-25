<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'user_id',
        'customer_id',
        'user_id',
        'profession_id',
        'name',
        'ref_id',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function reference()
    {
        return $this->belongsTo(User::class, 'ref_id')->withDefault(); 
    }

    public function profession(){
        return $this->belongsTo(Profession::class,'profession_id');
    }

    public static function generateNextCustomerId(){ 
        $user_id = User::where('user_type',2)->latest('id')->first()->user_id;
        if($user_id == null){
            $user_id = 'FL-000';
        }
        $numericPart = substr($user_id, 4);  
        $newNumericPart = str_pad((int)$numericPart + 1, strlen($numericPart), '0', STR_PAD_LEFT);
        $newValue = "FL-" . $newNumericPart; 
        return $newValue;
    }

}
