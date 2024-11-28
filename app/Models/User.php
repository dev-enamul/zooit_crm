<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail; 
use App\Traits\HasPermissionsTrait;
use App\Traits\UserAchiveTreat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasPermissionsTrait,UserAchiveTreat; 
    use SoftDeletes; 
    
  protected $fillable = ['user_id', 'name', 'phone', 'password', 'user_type', 'profile_image', 'approve_by', 'ref_id', 'status', 'created_by', 'updated_by', 'deleted_by', 'deleted_at', 'created_at', 'updated_at', 'serial', 'user_reporting', 'user_employee']; 
 
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
        $imagePath = 'public/'.$image;  
        if($image != null && $image != '' && Storage::exists($imagePath)){
            return asset('storage/'.$image);
        }else{ 
            if($this->user_type==2){
                return asset('../assets/images/users/avatar-1.png');
            }else{
                return asset('../assets/images/users/avatar-6.png');
            }
        }
    }

    public function signature(){
        $image = $this->signature;
        $imagePath = 'public/'.$image;  
        if($image != null && $image != '' && Storage::exists($imagePath)){
            return asset('storage/'.$image);
        }else{
            return false;
        }
    }

 
    public function companyType(){
        return $this->belongsTo(CompanyType::class,'company_type_id');
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

    public function referee()
    {
        return $this->belongsTo(User::class, 'ref_id');
    }

    public function age(){
        $dob = $this->dob;
        if($dob != null){
            $dob = date('Y-m-d', strtotime($dob));
            $dobObject = new \DateTime($dob);
            $nowObject = new \DateTime();
            $diff = $dobObject->diff($nowObject);
            return $diff->y;
        }else{
            return '';
        }
    }

    public function prospecting(){
        $this->hasMany(Prospecting::class,'user_id');
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

    public function field_target(){
        return $this->hasOne(FieldTarget::class,'assign_to');
    }

 

    public static function generateNextEmployeeId($user_id = null){
        if($user_id == null){
            $user_id = User::where('user_type',1)->latest('id')->first()->user_id;
        }
        
        if($user_id == null){
            $user_id = 'EMP-000';
        }
        $numericPart = substr($user_id, 4);  
        $newNumericPart = str_pad((int)$numericPart + 1, strlen($numericPart), '0', STR_PAD_LEFT); 
        $newValue = "EMP-" . $newNumericPart;
        $user = User::where('user_id',$newValue)->first();
        if($user != null){
            $newValue = self::generateNextEmployeeId($newValue);
        }
        return $newValue;
    }

    public static function generateNextVisitorId(){
        $largest_user_id = Customer::where('customer_id', 'like', 'VIS-%') 
        ->pluck('customer_id')
                ->map(function ($id) {
                        return preg_replace("/[^0-9]/", "", $id);
                }) 
        ->max(); 
        $largest_user_id++; 
        $new_user_id = 'VIS-' . str_pad($largest_user_id, 6, '0', STR_PAD_LEFT);
        return $new_user_id;
    }

    public static function generateNextCustomerId(){
        $largest_user_id = Customer::where('customer_id', 'like', 'CUS-%')
        ->pluck('customer_id')
                ->map(function ($id) {
                        return preg_replace("/[^0-9]/", "", $id);
                }) 
        ->max();  
        $largest_user_id++; 
        $new_user_id = 'CUS-' . str_pad($largest_user_id, 6, '0', STR_PAD_LEFT);
        return $new_user_id;
    }

    public static function generateNextProvableFreelancerId()
    {
        $largest_user_id = User::where('user_type', 2)
            ->where('user_id', 'like', 'PFL-%')
            ->pluck('user_id')
            ->map(function ($id) {
                    return preg_replace("/[^0-9]/", "", $id);
            }) 
            ->max();
        if($largest_user_id == null){
            $largest_user_id = 0;
        } 
        $largest_user_id++; 
        $new_user_id = 'PFL-' . str_pad($largest_user_id, 6, '0', STR_PAD_LEFT);
        return $new_user_id;
    } 

    public static function generateNextFreelancerId()
    {
        $largest_user_id = User::where('user_type', 2)
            ->where('user_id', 'like', 'FL-%')
            ->pluck('user_id')
            ->map(function ($id) {
                    return preg_replace("/[^0-9]/", "", $id);
            }) 
            ->max(); 
        $largest_user_id++; 
        $new_user_id = 'FL-' . str_pad($largest_user_id, 6, '0', STR_PAD_LEFT);
        return $new_user_id;
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

     

    public function my_employee(){
         $my_employee =  my_employee($this->id); 
         return $my_employee;
    }

    public function my_customer(){
        $my_customer = Customer::where('ref_id',$this->id)->where('deleted_at',null)->pluck('id')->toArray();
        return $my_customer;
    }  

    public function reportingUser()
    {
        return ReportingUser::where('user_id', $this->id)->where('status',1)->latest()->first();
    }

    public function my_reporting(){
        $my_reporting = json_decode($this->user_reporting); 
        if(isset($my_reporting) && count($my_reporting) > 1){
             $user  = User::where('id',$my_reporting['1'])->first();
        }else{
            $user = null;
        }
        return $user;
    }

    function my_top_reporting(){
        $my_reporting = json_decode($this->user_reporting); 
        if(isset($my_reporting) && count($my_reporting) > 1){
             $user  = User::where('id',end($my_reporting))->first();
        }else{
            $user = null;
        }
        return $user;
    } 
    
}
