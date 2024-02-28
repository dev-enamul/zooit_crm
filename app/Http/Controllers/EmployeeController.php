<?php

namespace App\Http\Controllers;
use App\Enums\BloodGroup;
use App\Enums\Gender;
use App\Enums\MaritualStatus;
use App\Enums\Nationality;
use App\Enums\Religion;
use App\Models\Area;
use App\Models\Bank; 
use App\Models\Designation;
use App\Models\DesignationPermission;
use App\Models\Employee; 
use App\Models\ReportingUser;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\UserContact;
use App\Models\UserFamily;
use App\Models\UserId;
use App\Models\UserPermission;
use App\Models\UserTransaction;
use App\Models\Zone;
use App\Rules\AtLeastOneFilledRule;
use App\Traits\AreaTrait;
use App\Traits\ImageUploadTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    use AreaTrait;
    use ImageUploadTrait;
    
    public function index(){ 
        $datas = User::where('status',1)->where('user_type',1)->latest('id')->get();
        // $latestUpdateUserAddress = UserAddress::orderBy('updated_at', 'desc')->first();
        // $latestUpdateReportingUser = ReportingUser::orderBy('updated_at', 'desc')->first();

        // $lastUpdateDate = max(
        //     optional($latestUpdateUserAddress)->updated_at,
        //     optional($latestUpdateReportingUser)->updated_at
        // ); 
        // if($latestUpdateUserAddress->updated_at > $latestUpdateReportingUser->updated_at){
        //     $lastUpdateDate = $latestUpdateUserAddress->updated_at;
        // }else{
        //     $lastUpdateDate = $latestUpdateReportingUser->updated_at;
        // }

        return view('employee.employee_list',compact('datas'));
    }

    public function create(){    
        $title     = "Employee Create";
        $countries = $this->getCachedCountries();
        $divisions = $this->getCachedDivisions();
        $districts = $this->getCachedDistricts();
        $upazilas  = $this->getCachedUpazilas();
        $unions    = $this->getCachedUnions();
        $villages  = $this->getCachedVillages();
        $nationalites = $this->nationality(); 
        $maritalStatuses = $this->maritalStatus();
        $religions = $this->religion();
        $bloodGroups = $this->bloodGroup();
        $genders = $this->gender(); 
        $banks = Bank::where('status',1)->where('type',0)->select('id','name')->get();
        $mobileBanks = Bank::where('status',1)->where('type',1)->select('id','name')->get();
        $zones = Zone::where('status',1)->select('id','name')->get();
        $areas = Area::where('status',1)->select('id','name')->get();
        $designations = Designation::where('status',1)->where('designation_type',1)->select('id','title')->get(); 
        $reporting_user = User::where('status',1)->where('user_type',1)->select('id','name','user_id')->get();
        
        return view('employee.employee_create',compact([ 
            'title',
            'countries',
            'divisions',
            'districts',
            'upazilas',
            'unions',
            'villages', 
            'maritalStatuses',
            'religions',
            'bloodGroups',
            'genders',
            'banks',
            'mobileBanks',
            'zones',
            'areas',
            'nationalites',
            'designations', 
            'reporting_user'
        ]));
    } 

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name'                 => 'required|string|max:255', 
            'marital_status'            => 'required|in:1,2,3',
            'dob'                       => 'required',
            'card_id'                   => 'nullable|string',
            'religion'                  => 'required|numeric',
            'blood_group'               => 'nullable|numeric',
            'gender'                    => 'required|in:1,2',
            'phone1'                    => 'required|string|unique:users,phone|max:15',
            'phone2'                    => 'nullable|string|max:15',
            'office_email'              => 'nullable|email',
            'email'                     => 'nullable|email',
            'imo_whatsapp_number'       => 'nullable|string',
            'facebook_id'               => 'nullable|string',
            'emergency_contact_name'    => 'nullable|string',
            'emergency_person_number'   => 'nullable|string', 
            'division'                  => 'required|numeric|exists:divisions,id',
            'district'                  => 'required|numeric|exists:districts,id',
            'upazila'                   => 'required|numeric|exists:upazilas,id',
            'union'                     => 'required|numeric|exists:unions,id',
            'village'                   => 'nullable|numeric|exists:villages,id',
            'address'                   => 'nullable|string',
            'zone'                      => 'nullable|numeric|exists:zones,id',
            'area'                      => 'nullable|numeric|exists:areas,id',
            'father_name'               => 'required|string',
            'father_phone'              => 'nullable|string|max:15',
            'mother_name'               => 'required|string',
            'mother_phone'              => 'nullable|string|max:15',
            'spouse_name'               => 'nullable|string',
            'spouse_phone'              => 'nullable|string|max:15',
            'bank'                      => 'nullable|numeric|exists:banks,id',
            'branch'                    => 'nullable|string',
            'account_number'            => 'nullable|string',
            'account_holder_name'       => 'nullable|string',
            'mobile_bank'               => 'nullable|numeric|exists:banks,id',
            'mobile_bank_number'        => 'nullable|string',
            'passport_issue_date'       => 'nullable',
            'passport_expire_date'      => 'nullable',
            'tin_number'                => 'nullable|string',
            'profile_image'             => 'image|max:2048',
            'nid_file'                  => 'image|max:2048',
            'birth_certificate_file'    => 'image|max:2048',
            'upload_passport'           => 'image|max:2048',
            'reporting_user'            => 'required|numeric|exists:users,id',
            'designation'               => 'required|numeric|exists:designations,id',
            'at_least_one_field' => [
                'sometimes', new AtLeastOneFilledRule('nid', 'birth_certificate_number', 'passport_number'),
            ],
        ]);
        if ($validator->fails()) { 
            return redirect()->back()->withInput()->withErrors($validator)->with('error', $validator->errors()->first());
        } 

        DB::beginTransaction(); 
       
        try { 
            $user = User::create([
                'user_id'       => User::generateNextEmployeeId(),
                'name'          => $request->full_name,
                'phone'         => get_phone($request->phone1),
                'password'      => bcrypt('123456'),
                'user_type'     => 1,
                'marital_status'=> $request->marital_status,
                'dob'           => date('Y-m-d', strtotime($request->dob)),
                'finger_id'     => $request->card_id,
                'religion'      => $request->religion,
                'blood_group'   => $request->blood_group,
                'gender'        => $request->gender,
                'nationality'   => $request->nationality,
                'status'        => 1,
                'created_by'    => auth()->user()->id,
                'approve_by'    => auth()->user()->id,
                'ref_id'        => auth()->user()->id
            ]);

            if ($request->hasFile('profile_image')) {
                $user->profile_image = $this->uploadImage($request, 'profile_image', 'users', 'public');
                $user->save();
            }

            UserAddress::create([
                'user_id'       => $user->id,
                'country_id'    => $request->country,
                'division_id'   => $request->division,
                'district_id'   => $request->district,
                'upazila_id'    => $request->upazila,
                'union_id'      => $request->union,
                'village_id'    => $request->village,
                'address'       => $request->address,
                'zone_id'       => $request->zone,
                'area_id'       => $request->area,
                'created_at'    => now(),
            ]);

            #user contacts 
            UserContact::create([
                'user_id'                   => $user->id,
                'personal_phone'            => get_phone($request->phone1),
                'office_phone'              => get_phone($request->phone2),
                'office_email'              => $request->office_email,
                'personal_email'            => $request->email,
                'imo_number'                => get_phone($request->imo_whatsapp_number),
                'facebook_id'               => $request->facebook_id, 
                'emergency_contact_person'  => $request->emergency_contact_name,
                'emergency_contact_number'  => get_phone($request->emergency_person_number),
                'created_at'                => now(),
            ]);

            #user family 
            UserFamily::create([
                'user_id'               => $user->id,
                'father_name'           => $request->father_name,
                'father_mobile'         => get_phone($request->father_phone),
                'mother_name'           => $request->mother_name,
                'mother_mobile'         => get_phone($request->mother_phone),
                'spouse_name'           => $request->spouse_name,
                'spouse_contact'        => get_phone($request->spouse_phone),
                'created_at'            => now(),
            ]);
             

            #user transaction
            $data_transaction = [
                'user_id'                       => $user->id,
                'bank_id'                       => $request->bank,
                'branch'                        => $request->branch,
                'bank_account_number'           => $request->account_number,
                'bank_details'                  => $request->account_holder_name,
                'mobile_bank_id'                => $request->mobile_bank,
                'mobile_bank_account_number'    => get_phone($request->mobile_bank_number),
                'created_at'                    => now(),
            ];
            UserTransaction::create($data_transaction);

            #user documents
            if ($request->hasFile('nid_file')) {
                $nid_file = $this->uploadImage($request, 'nid_file', 'users', 'public');
            }
            if ($request->hasFile('birth_certificate_file')) {
                $birth_certificate_file = $this->uploadImage($request, 'birth_certificate_file', 'users', 'public');
            }
            if ($request->hasFile('upload_passport')) {
                $upload_passport = $this->uploadImage($request, 'upload_passport', 'users', 'public');
            }
            $user_documents = [
                'user_id'                   => $user->id,
                'nid_number'                => $request->nid,
                'nid_image'                 => $nid_file ?? null,
                'birth_cirtificate_number'  => $request->birth_certificate_number,
                'birth_cirtificate_image'   => $birth_certificate_file ?? null,
                'passport_number'           => $request->passport_number,
                // 'passport_issue_date'       => date('Y-m-d', strtotime($request->passport_issue_date)),
                'passport_exp_date'         => date('Y-m-d', strtotime($request->passport_expire_date)),
                'passport_image'            => $upload_passport ?? null,
                'tin_number'                => $request->tin_number,
                'created_at'                => now(),
            ];
            UserId::create($user_documents);

            $employee_data = [
                'user_id'       => $user->id,
                'designation_id'=> $request->designation,
                'status'        => 1,
                'created_at'    => now(),
            ]; 
            Employee::create($employee_data);  

            $permissions = DesignationPermission::where('designation_id', $request->designation)->pluck('permission_id')->toArray();
            foreach($permissions as $permission){
                UserPermission::create([
                    'user_id'       => $user->id,
                    'permission_id' => $permission,
                ]);
            } 
            
            $reportingUser = ReportingUser::where('user_id',$request->reporting_user)->where('deleted_at',null)->first(); 
            if ($reportingUser) {
                $reportingUserId = $reportingUser->id;
                ReportingUser::create([
                    'user_id'               => $user->id,
                    'reporting_user_id'   => $reportingUserId,
                    'status'                => 1,
                    'created_at'            => now(),
                ]);
            } 
            DB::commit(); 
            return redirect()->route('employee.index')->with('success', 'Employee created successfully');
        } catch (Exception $e) {   
            DB::rollback();
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $id = decrypt($id); 
        $title     = "Employee Edit";
        $countries = $this->getCachedCountries();
        $divisions = $this->getCachedDivisions();
        $districts = $this->getCachedDistricts();
        $upazilas  = $this->getCachedUpazilas();
        $unions    = $this->getCachedUnions();
        $villages  = $this->getCachedVillages();
        $nationalites = $this->nationality(); 
        $maritalStatuses = $this->maritalStatus();
        $religions = $this->religion();
        $bloodGroups = $this->bloodGroup();
        $genders = $this->gender();
        $ref_ids = User::where('status',1)->get();
        $banks = Bank::where('status',1)->where('type',0)->select('id','name')->get();
        $mobileBanks = Bank::where('status',1)->where('type',1)->select('id','name')->get();
        $zones = Zone::where('status',1)->select('id','name')->get();
        $areas = Area::where('status',1)->select('id','name')->get();
        $designations = Designation::where('status',1)->where('designation_type',1)->select('id','title')->get(); 
        $reporting_user = ReportingUser::where('status',1)->get();

        $employee = Employee::where('user_id',$id)->first();
        if(!$employee){
            return redirect()->back()->with('error', 'Employee Not Found');
        }

        $selected['country_id']   = $employee->user->userAddress->country_id??1;
        $selected['division_id']  = $employee->user->userAddress->division_id??1;
        $selected['district_id']  = $employee->user->userAddress->district_id??1;
        $selected['upazila_id']   = $employee->user->userAddress->upazila_id??1;
        $selected['union_id']     = $employee->user->userAddress->union_id??1;
        $selected['village_id']   = $employee->user->userAddress->village_id??1;
 
        return view('employee.employee_edit',compact([
            'ref_ids',
            'title',
            'countries',
            'divisions',
            'districts',
            'upazilas',
            'unions',
            'villages', 
            'maritalStatuses',
            'religions',
            'bloodGroups',
            'genders',
            'banks',
            'mobileBanks',
            'zones',
            'areas',
            'nationalites',
            'designations', 
            'reporting_user',
            'employee',
            'selected'
            
        ]));
    }

    public function update(Request $request, $id){
       
        $validator = Validator::make($request->all(), [
            'full_name'                 => 'required|string|max:255', 
            'marital_status'            => 'required|in:1,2,3',
            'dob'                       => 'required',
            'card_id'                   => 'nullable|string',
            'religion'                  => 'required|numeric',
            'blood_group'               => 'nullable|numeric',
            'gender'                    => 'required|in:1,2', 
            'phone2'                    => 'nullable|string|max:15',
            'office_email'              => 'nullable|email',
            'email'                     => 'nullable|email',
            'imo_whatsapp_number'       => 'nullable|string',
            'facebook_id'               => 'nullable|string',
            'emergency_contact_name'    => 'nullable|string',
            'emergency_person_number'   => 'nullable|string', 
            'division'                  => 'required|numeric|exists:divisions,id',
            'district'                  => 'required|numeric|exists:districts,id',
            'upazila'                   => 'required|numeric|exists:upazilas,id',
            'union'                     => 'required|numeric|exists:unions,id',
            'village'                   => 'nullable|numeric|exists:villages,id',
            'address'                   => 'nullable|string',
            'zone'                      => 'nullable|numeric|exists:zones,id',
            'area'                      => 'nullable|numeric|exists:areas,id',
            'father_name'               => 'required|string',
            'father_phone'              => 'nullable|string|max:15',
            'mother_name'               => 'required|string',
            'mother_phone'              => 'nullable|string|max:15',
            'spouse_name'               => 'nullable|string',
            'spouse_phone'              => 'nullable|string|max:15',
            'bank'                      => 'nullable|numeric|exists:banks,id',
            'branch'                    => 'nullable|string',
            'account_number'            => 'nullable|string',
            'account_holder_name'       => 'nullable|string',
            'mobile_bank'               => 'nullable|numeric|exists:banks,id',
            'mobile_bank_number'        => 'nullable|string',
            'passport_issue_date'       => 'nullable',
            'passport_expire_date'      => 'nullable',
            'tin_number'                => 'nullable|string',
            'profile_image'             => 'image|max:2048',
            'nid_file'                  => 'image|max:2048',
            'birth_certificate_file'    => 'image|max:2048',
            'upload_passport'           => 'image|max:2048', 
            'at_least_one_field' => [
                'sometimes', new AtLeastOneFilledRule('nid', 'birth_certificate_number', 'passport_number'),
            ],
        ]);

        if ($validator->fails()) { 
            return redirect()->back()->withInput()->withErrors($validator)->with('error', $validator->errors()->first());
        } 
        DB::beginTransaction();  
        $user = User::find($id);
        if(!$user){
            return redirect()->back()->with('error', 'User Not Found');
        }
        try { 
            $user->update([ 
                'name'          => $request->full_name,
                // 'phone'         => get_phone($request->phone1),  
                'marital_status'=> $request->marital_status,
                'dob'           => date('Y-m-d', strtotime($request->dob)),
                'finger_id'     => $request->card_id,
                'religion'      => $request->religion,
                'blood_group'   => $request->blood_group,
                'gender'        => $request->gender,
                'nationality'   => $request->nationality, 
                'updated_by'    => auth()->user()->id,  
            ]);

            if ($request->hasFile('profile_image')) {
                $user->profile_image = $this->uploadImage($request, 'profile_image', 'users', 'public');
                $user->save();
            }

            $address_data = [ 
                'country_id'    => $request->country,
                'division_id'   => $request->division,
                'district_id'   => $request->district,
                'upazila_id'    => $request->upazila,
                'union_id'      => $request->union,
                'village_id'    => $request->village,
                'address'       => $request->address, 
            ];
            if($user->userAddress){ 
                $user->userAddress->update($address_data);
            }else{
                $address_data['user_id'] = $user->id;
                UserAddress::create($address_data);
            } 
 
            $contact_data = [ 
                'personal_phone'            => get_phone($request->phone1),
                'office_phone'              => get_phone($request->phone2),
                'office_email'              => $request->office_email,
                'personal_email'            => $request->email,
                'imo_number'                => get_phone($request->imo_whatsapp_number),
                'facebook_id'               => $request->facebook_id, 
                'emergency_contact_person'  => $request->emergency_contact_name,
                'emergency_contact_number'  => get_phone($request->emergency_person_number), 
            ];
            if($user->userContact){
                $user->userContact->update($contact_data);
            }else{
                $contact_data['user_id'] = $user->id;
                UserContact::create($contact_data);
            } 
 
            $family_data = [ 
                'father_name'           => $request->father_name,
                'father_mobile'         => get_phone($request->father_phone),
                'mother_name'           => $request->mother_name,
                'mother_mobile'         => get_phone($request->mother_phone),
                'spouse_name'           => $request->spouse_name,
                'spouse_contact'        => get_phone($request->spouse_phone), 
            ];

            if($user->userFamily){
                $user->userFamily->update($family_data);
            }else{
                $family_data['user_id'] = $user->id;
                UserFamily::create($family_data);
            } 
             

            #user transaction
            $data_transaction = [ 
                'bank_id'                       => $request->bank,
                'branch'                        => $request->branch,
                'bank_account_number'           => $request->account_number,
                'bank_details'                  => $request->account_holder_name,
                'mobile_bank_id'                => $request->mobile_bank,
                'mobile_bank_account_number'    => get_phone($request->mobile_bank_number),
                'created_at'                    => now(),
            ];
            if($user->userTransaction){
                $user->userTransaction->update($data_transaction);
            }else{
                $data_transaction['user_id'] = $user->id;
                UserTransaction::create($data_transaction);
            } 

            #user documents
            if ($request->hasFile('nid_file')) {
                $nid_file = $this->uploadImage($request, 'nid_file', 'users', 'public');
            }
            if ($request->hasFile('birth_certificate_file')) {
                $birth_certificate_file = $this->uploadImage($request, 'birth_certificate_file', 'users', 'public');
            }
            if ($request->hasFile('upload_passport')) {
                $upload_passport = $this->uploadImage($request, 'upload_passport', 'users', 'public');
            }
            $user_documents = [ 
                'nid_number'                => $request->nid,
                'nid_image'                 => $nid_file ?? null,
                'birth_cirtificate_number'  => $request->birth_certificate_number,
                'birth_cirtificate_image'   => $birth_certificate_file ?? null,
                'passport_number'           => $request->passport_number, 
                'passport_exp_date'         => date('Y-m-d', strtotime($request->passport_expire_date)),
                'passport_image'            => $upload_passport ?? null,
                'tin_number'                => $request->tin_number, 
            ];

            if($user->userId){
                $user->userId->update($user_documents);
            }else{
                $user_documents['user_id'] = $user->id;
                UserId::create($user_documents);
            } 
             
  
            DB::commit(); 
            return redirect()->route('employee.index')->with('success', 'Employee Updated successfully');
        } catch (Exception $e) {  
            dd($e->getMessage());
            DB::rollback();
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    } 
 


    public function maritalStatus()
    {
        return MaritualStatus::values();
    }

    public function religion()
    {
        return Religion::values();
    }
    
    public function bloodGroup()
    {
        return BloodGroup::values();
    }

    public function gender()
    {
        return Gender::values();
    }

    public function nationality()
    {
        return Nationality::values();
    }

    public function userDetails($id) {
        $id = decrypt($id); 
        $user = User::find($id); 
        if(!$user){
            return redirect()->back()->with('error', 'User Not Found');
        }

        return view('employee.employee_details',compact('user'));
    }
}
