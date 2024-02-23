<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail; 
use App\Traits\HasPermissionsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasPermissionsTrait; 
    use SoftDeletes; 
    
  protected $fillable = [
        'user_id',
        'name',
        'phone',
        'password',
        'user_type',
        'profile_image',
        'marital_status',
        'dob',
        'finger_id',
        'religion',
        'blood_group',
        'gender',
        'professions_id',
        'ref_id',
        'created_by',
        'updated_by',
        'deleted_by',
    ]; 
 
    protected $hidden = [
        'password',
        'remember_token',
    ];

  
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ]; 

    protected $dates = ['deleted_at'];

    public function image(){
         $image = $this->profile_image;
         if($image != null && $image != '' && file_exists('storage/'.$image)){
            return asset('storage/'.$image);
         }else{
            return asset('../assets/images/users/avatar-6.png');
         }
    } 

    public function profession()
    {
        return $this->belongsTo(Profession::class, 'professions_id');
    } 

    public function freelancer()
    {
        return $this->hasOne(Freelancer::class, 'user_id');
    }

    public function employee()
    {
        return $this->hasOne(Employee::class, 'user_id');
    }

    public function customer()
    {
        return $this->hasMany(Customer::class, 'user_id');
    }

    public function reportingUser()
    {
        return $this->hasOne(ReportingUser::class, 'user_id')->whereNull('deleted_at');
    }

    public function referee()
    {
        return $this->belongsTo(User::class, 'ref_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }

    public static function generateNextUserId()
    {
        $lastUserId = self::latest('id')->value('user_id');

        if ($lastUserId) {
            $numericPart     = (int)substr($lastUserId, 4);
            $nextNumericPart = $numericPart + 1;
            $nextUserId      = 'FL-' . str_pad($nextNumericPart, 4, '0', STR_PAD_LEFT);
        } else {
            $nextUserId      = 'FL-0001';
        }

        return $nextUserId;
    }

    public static function generateNextEmployeeId(){
        $user_id = User::where('user_type',1)->latest('id')->first()->user_id;
        if($user_id == null){
            $user_id = 'EMP-000';
        }
        $numericPart = substr($user_id, 4);  
        $newNumericPart = str_pad((int)$numericPart + 1, strlen($numericPart), '0', STR_PAD_LEFT); 
        $newValue = "EMP-" . $newNumericPart; 
        return $newValue;
    }

    public static function generateNextCustomerId(){ 
        $customer = Customer::latest('id')->first()->customer_id;
        if($customer == null){
            $customer = 'CUS-000';
        }
        $numericPart = substr($customer, 4);
        $newNumericPart = str_pad((int)$numericPart + 1, strlen($numericPart), '0', STR_PAD_LEFT);
        $newValue = "CUS-" . $newNumericPart; 
        return $newValue;
    }

    public static function generateNextUserCustomerId()
    {
        $lastUserId = self::latest('id')->value('user_id');

        if ($lastUserId) {
            $numericPart     = (int)substr($lastUserId, 4);
            $nextNumericPart = $numericPart + 1;
            $nextUserId      = 'CS-' . str_pad($nextNumericPart, 4, '0', STR_PAD_LEFT);
        } else {
            $nextUserId      = 'CS-0001';
        }

        return $nextUserId;
    }

    public static function generateNextEmail()
    {
        $lastEmail = self::latest('id')->value('email');

        if ($lastEmail) {
            preg_match('/\d+$/', $lastEmail, $matches);
            $numericPart = $matches[0] ?? 1;
            $nextNumericPart = $numericPart + 1;
            $nextEmail = 'freelancer' . $nextNumericPart . '@wayhouse.com';
        } else {
            $nextEmail = 'freelancer1@wayhouse.com';
        }

        return $nextEmail;
    }

    public static function generateCustomerNextEmail()
    {
        $lastEmail = self::latest('id')->value('email');

        if ($lastEmail) {
            preg_match('/\d+$/', $lastEmail, $matches);
            $numericPart = $matches[0] ?? 1;
            $nextNumericPart = $numericPart + 1;
            $nextEmail = 'customer' . $nextNumericPart . '@wayhouse.com';
        } else {
            $nextEmail = 'customer1@wayhouse.com';
        }

        return $nextEmail;
    }

    public function userAddress()
    {
        return $this->hasOne(UserAddress::class);
    }

    public function userContact()
    {
        return $this->hasOne(UserContact::class);
    }

    public  function userFamily()
    {
        return $this->hasOne(UserFamily::class);
    }

    public  function userTransaction()
    {
        return $this->hasOne(UserTransaction::class);
    }

    public  function userId()
    {
        return $this->hasOne(UserId::class);
    }

    public function my_all_employee(){
        $topUser = \App\Models\ReportingUser::where('user_id', auth()->user()->id)
        ->select(['id', 'user_id'])
        ->first(); 
        return my_all_employee($topUser); 
    }  
 

    


    
}
