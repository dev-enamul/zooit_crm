<?php

namespace App\Imports;

use App\Models\Customer;
use App\Models\DesignationPermission;
use App\Models\Employee;
use App\Models\Freelancer;
use App\Models\ReportingUser;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\UserContact;
use App\Models\UserFamily;
use App\Models\UserId;
use App\Models\UserPermission;
use App\Models\UserTransaction;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UserImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    { 
        if (empty($row['name'])) {
            return null; 
        } 

        if (empty($row['office_phone']) && empty($row['personal_phone'])) {
            return null; 
        } 

        if(isset($row['office_phone']) && $row['office_phone'] != null){
            $phone = get_phone($row['office_phone']);
        }elseif(isset($row['personal_phone']) && $row['personal_phone'] != null){
            $phone = get_phone($row['personal_phone']);
        }

        
         $old_user = User::where('phone', $phone)->first();
         if(isset($old_user) && $old_user != null){ 
            if($old_user->user_type==3){
                
            }else{
                return null;
            } 
         }

        if ($row['user_type']==3) {
            $user_id = null;
        }else{
            $user_id = $row['user_id'];
        }
 
       
        if(isset($old_user) && $old_user){
            $user = $old_user;
        }else{
            $user = User::create([
                'user_id'       => $user_id,
                'name'          => $row['name'],
                'phone'         => $phone,
                'password'      => bcrypt('123456'),
                'user_type'     => $row['user_type'],
                'marital_status'=> is_int($row['marital_status'])? $row['marital_status']:null,
                'dob'           => Carbon::parse($row['dob'])->format('Y-m-d'),
                'finger_id'     => $row['finger_id'],
                'religion'      => is_int($row['religion'])? $row['religion']:null,
                'blood_group'   => is_int($row['blood_group'])? $row['blood_group']:null,
                'gender'        => is_int($row['gender'])? $row['gender']:null,
                'nationality'   => is_int($row['nationality'])? $row['nationality']:null,
                'status'        => 1,
                'created_by'    => auth()->user()->id,
                'approve_by'    => auth()->user()->id,
                'ref_id'        => auth()->user()->id
            ]); 
        }
        
        
        UserAddress::create([
            'user_id'       => $user->id,
            'country_id'    => 18,
            'division_id'   => is_int($row['division_id'])? $row['division_id']:null,
            'district_id'   => is_int($row['district_id'])? $row['district_id']:null,
            'upazila_id'    => is_int($row['upazila_id'])? $row['upazila_id']:null,
            'union_id'      => is_int($row['union_id'])? $row['union_id']:null,
            'village_id'    => is_int($row['village_id'])? $row['village_id']:null,
            'address'       => $row['address'],
            'zone_id'       => is_int($row['zone_id'])? $row['zone_id']:null,
            'area_id'       => is_int($row['area_id'])? $row['area_id']:null,
            'created_at'    => now(),
        ]);

        #user contacts 
        UserContact::create([
            'user_id'                   => $user->id,
            'personal_phone'            => $row['personal_phone'],
            'office_phone'              => $row['office_phone'],
            'office_email'              => $row['office_email'],
            'personal_email'            => $row['personal_email'],
            'imo_number'                => $row['imo_number'],
            'facebook_id'               => $row['facebook_id'],
            'emergency_contact_person'  => $row['emergency_contact_person'],
            'emergency_contact_number'  => $row['emergency_contact_number'],
            'created_at'                => now(),
        ]);

        #user family 
        UserFamily::create([
            'user_id'               => $user->id,
            'father_name'           => $row['father_name'],
            'father_mobile'         => $row['father_mobile'],
            'mother_name'           => $row['mother_name'],
            'mother_mobile'         => $row['mother_mobile'],
            'spouse_name'           => $row['spouse_name'],
            'spouse_contact'        => $row['spouse_contact'],
            'created_at'            => now(),
        ]);
         

        #user transaction
        $data_transaction = [
            'user_id'                       => $user->id,
            'bank_id'                       => is_int($row['bank_id'])? $row['bank_id']:null,
            'branch'                        => $row['branch'],
            'bank_account_number'           => $row['bank_account_number'],
            'bank_details'                  => $row['bank_details'],
            'mobile_bank_id'                => is_int($row['mobile_bank_id'])? $row['mobile_bank_id']:null,
            'mobile_bank_account_number'    => $row['mobile_bank_account_number'],
            'created_at'                    => now(),
        ]; 

        UserTransaction::create($data_transaction); 
      
        $user_documents = [
            'user_id'                   => $user->id,
            'nid_number'                => $row['nid_number'], 
            'birth_cirtificate_number'  => $row['birth_cirtificate_number'], 
            'passport_number'           => $row['passport_number'], 
            'passport_exp_date'         => $row['passport_exp_date']?Carbon::parse($row['passport_exp_date'])->format('Y-m-d'):null, 
            'tin_number'                => $row['tin_number'],
            'created_at'                => now(),
        ];  
        UserId::create($user_documents);

        if($row['user_type']==1){
            $employee_data = [
                'user_id'       => $user->id,
                'designation_id'=> $row['designation_id'],
                'status'        => 1,
                'created_at'    => now(),
            ]; 
            Employee::create($employee_data);  
        }elseif($row['user_type']==2){
            $freelancer_data = [
                'user_id'           => $user->id,
                'designation_id'    => is_int($row['designation_id'])? $row['designation_id']:null,
                'profession_id'     => is_int($row['profession_id'])? $row['profession_id']:null,
                'status'            => 1,
                'last_approve_by'   => auth()->user()->id,
                'ref_id'            => auth()->user()->id, 
                'created_at'        => now(),
            ]; 
            Freelancer::create($freelancer_data);  
        }elseif($row['user_type']==3){
            $customer_data = [
                'user_id'       => $user->id,
                'customer_id'   => $row['customer_id'],
                'profession_id' => is_int($row['profession_id'])? $row['profession_id']:null,
                'name'          => $row['name'],
                'ref_id'        => auth()->user()->id,
                'approve_by'    => auth()->user()->id, 
                'status'        => 0, 
                'created_by'    => auth()->user()->id,
                'created_at'    => now(),
            ]; 
            Customer::create($customer_data);  
        }

        if($row['user_type']!=3){
            $reportingUser = ReportingUser::where('user_id',1)->where('deleted_at',null)->first(); 
            if ($reportingUser) {
                $reportingUserId = $reportingUser->id;
                ReportingUser::create([
                    'user_id'               => $user->id,
                    'reporting_user_id'   => $reportingUserId,
                    'status'                => 1,
                    'created_at'            => now(),
                ]);
            } 

            $permissions = DesignationPermission::where('designation_id', $row['designation_id'])->pluck('permission_id')->toArray();
                foreach($permissions as $permission){
                    UserPermission::create([
                        'user_id'       => $user->id,
                        'permission_id' => $permission,
                    ]);
                } 

        }
        
         
        return $user;
    }
}
