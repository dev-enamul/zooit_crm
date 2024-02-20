<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserId extends Model
{
    use HasFactory; 

    protected $fillable = [
        'user_id',
        'nid_number',
        'nid_image',
        'birth_cirtificate_number',
        'birth_cirtificate_image',
        'passport_number',
        'passport_image',
        'passport_issue_date',
        'passport_exp_date',
        'tin_number',
    ];

    public function nid_image(){ 
        $nid = $this->nid_image;
        if($nid != null && $nid != '' && file_exists('storage/'.$nid)){  
            return asset('storage/'.$nid);
        }else{
            return asset('../assets/images/default/blank.png');
        }
    } 

    public function birth_image(){ 
        $birth = $this->birth_cirtificate_image;
        if($birth != null && $birth != '' && file_exists('storage/'.$birth)){  
            return asset('storage/'.$birth);
        }else{
            return asset('../assets/images/default/blank.png');
        }
    } 

    public function passport_image(){ 
        $passport = $this->passport_image;
        if($passport != null && $passport != '' && file_exists('storage/'.$passport)){  
            return asset('storage/'.$passport);
        }else{
            return asset('../assets/images/default/blank.png');
        }
    } 

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
