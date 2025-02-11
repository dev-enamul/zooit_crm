<?php

namespace App\Http\Controllers;

use App\DataTables\FreelancersDataTable;
use App\Enums\BloodGroup;
use App\Enums\Gender;
use App\Models\Freelancer;
use App\Models\Notification;
use App\Models\Profession;
use App\Traits\AreaTrait;
use App\Traits\ImageUploadTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Enums\MaritualStatus;
use App\Enums\Nationality;
use App\Enums\Religion;
use App\Events\UserCreatedEvent;
use App\Models\ApproveSetting;
use App\Models\Area;
use App\Models\Bank;
use App\Models\Designation;
use App\Models\DesignationPermission;
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
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class FreelancerController extends Controller
{
    use AreaTrait;
    use ImageUploadTrait;

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

    public function index(FreelancersDataTable $dataTable, Request $request){
        $title = 'Freelancer List';
        $date = $request->date??null;
        $status = $request->status??0;
        $start_date = Carbon::parse($date ? explode(' - ',$date)[0] : date('Y-m-01'))->format('Y-m-d');
        $end_date = Carbon::parse($date ? explode(' - ',$date)[1] : date('Y-m-t'))->format('Y-m-d');
        $employee = $request->employee??null;
        $employee = $employee ? User::find($employee)?? User::find(auth()->user()->id) :  User::find(auth()->user()->id);

        return $dataTable->render('freelancer.freelancer_list',compact('title','status','employee','start_date','end_date'));
    }

    public function create(){
        $title     = "Freelancer Create";
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
        $designations = Designation::where('status',1)->where('designation_type',2)->select('id','title')->get();
        $professions = Profession::where('status',1)->select('id','name')->get();

        return view('freelancer.freelancer_save', compact(
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
            'professions'
        ));
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name'                 => 'required|string|max:255',
            'marital_status'            => 'nullable',
            'profession'                => 'required|numeric|exists:professions,id',
            'dob'                       => 'nullable',
            'card_id'                   => 'nullable|string',
            'religion'                  => 'required|numeric',
            'blood_group'               => 'nullable|numeric',
            'gender'                    => 'required',
            'phone1'                    => 'required|string|unique:users,phone|max:15',
            'phone2'                    => 'nullable|string|max:15',
            'office_email'              => 'nullable|email',
            'email'                     => 'nullable|email',
            'imo_whatsapp_number'       => 'nullable|string',
            'facebook_id'               => 'nullable|string',
            'emergency_contact_name'    => 'nullable|string',
            'emergency_person_number'   => 'nullable|string',
            'division'                  => 'nullable|numeric|exists:divisions,id',
            'district'                  => 'nullable|numeric|exists:districts,id',
            'upazila'                   => 'nullable|numeric|exists:upazilas,id',
            'union'                     => 'nullable|numeric|exists:unions,id',
            'village'                   => 'nullable|numeric|exists:villages,id',
            'address'                   => 'nullable|string',
            'zone'                      => 'nullable|numeric|exists:zones,id',
            'area'                      => 'nullable|numeric|exists:areas,id',
            'father_name'               => 'nullable|string',
            'father_phone'              => 'nullable|string|max:15',
            'mother_name'               => 'nullable|string',
            'mother_phone'              => 'nullable|string|max:15',
            'spouse_name'               => 'nullable|string',
            'spouse_phone'              => 'nullable|string|max:15',
            'bank'                      => 'nullable|numeric|exists:banks,id',
            'branch'                    => 'nullable|string',
            'account_number'            => 'nullable|string',
            'account_holder_name'       => 'nullable|string',
            'mobile_bank'               => 'nullable|numeric|exists:banks,id',
            'mobile_bank_number'        => 'nullable|string|max:15',
            'passport_issue_date'       => 'nullable',
            'passport_expire_date'      => 'nullable',
            'tin_number'                => 'nullable|string',
            'profile_image'             => 'image|max:2048',
            'nid_file'                  => 'image|max:2048',
            'birth_certificate_file'    => 'image|max:2048',
            'upload_passport'           => 'image|max:2048',
            'reporting_user'            => 'required|numeric|exists:reporting_users,id',
            'designation'               => 'required|numeric|exists:designations,id',
            // 'at_least_one_field' => [
            //     'sometimes', new AtLeastOneFilledRule('nid', 'birth_certificate_number', 'passport_number'),
            // ],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator)->with('error', $validator->errors()->first());
        }

        DB::beginTransaction();
        try {

            if(isset($request->reporting_user) && $request->reporting_user != null){
                $ref_user = ReportingUser::find($request->reporting_user);
                if(isset($ref_user) && $ref_user != null){
                    $ref_id = $ref_user->user_id;
                }else{
                    $ref_id = Auth::user()->id;
                }
            }

            $user = User::create([
                'user_id'       => $request->freelancer_id??User::generateNextProvableFreelancerId(),
                'name'          => $request->full_name,
                'phone'         => get_phone($request->phone1),
                'password'      => bcrypt('123456'),
                'user_type'     => 2,
                'marital_status'=> $request->marital_status,
                'dob'           => date('Y-m-d', strtotime($request->dob)),
                'finger_id'     => $request->card_id,
                'religion'      => $request->religion,
                'blood_group'   => $request->blood_group,
                'gender'        => $request->gender,
                'nationality'   => $request->nationality,
                'status'        => 0,
                'created_by'    => auth()->user()->id,
                'ref_id'        => $ref_id,
            ]);

            if ($request->hasFile('profile_image')) {
                $user->profile_image = $this->uploadImage($request, 'profile_image', 'users', 'public');
                $user->save();
            }

            UserAddress::create([
                'user_id'       => $user->id,
                'country_id'    => 18,
                'division_id'   => $request->division,
                'district_id'   => $request->district,
                'upazila_id'    => $request->upazila,
                'union_id'      => $request->union,
                'post_code'     => $request->post_code,
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
                'passport_exp_date'         => date('Y-m-d', strtotime($request->passport_expire_date)),
                'passport_image'            => $upload_passport ?? null,
                'tin_number'                => $request->tin_number,
                'created_at'                => now(),
            ];
            UserId::create($user_documents);

            $employee_data = [
                'user_id'           => $user->id,
                'profession_id'     => $request->profession,
                'designation_id'    => $request->designation,
                'ref_id'            => $ref_id,
                'last_approve_by'   => Auth::user()->id,
                'status'            => 0,
                'created_at'        => now(),
                'created_by'        =>Auth::user()->id,
            ];
            Freelancer::create($employee_data);

            $permissions = DesignationPermission::where('designation_id', $request->designation)->pluck('permission_id')->toArray();
            foreach($permissions as $permission){
                UserPermission::create([
                    'user_id'       => $user->id,
                    'permission_id' => $permission,
                ]);
            }

            if(isset($request->reporting_user) && $request->reporting_user != null){
                ReportingUser::create([
                    'user_id'               => $user->id,
                    'reporting_user_id'   =>   $request->reporting_user,
                    'status'                => 1,
                    'created_at'            => now(),
                ]);
            }

            // for freelancer approve
            $approve_setting = ApproveSetting::where('name','freelancer')->first();
            $is_admin = Auth::user()->hasPermission('admin');
            if($approve_setting?->status == 0 || $is_admin){
                $controller = new ApproveFreelancerController();
                $controller->complete_training(encrypt($user->id));
            }else{
                $employee = Auth::user();
                if(!empty($employee) && count(json_decode($employee->user_reporting))>1) {
                    Notification::store([
                        'title' => 'Freelancer approve request',
                        'content' => auth()->user()->name . ' has created a freelancer please approve as soon as possible',
                        'link' => url('approve-freelancer'),
                        'created_by' => auth()->user()->id,
                        'user_id' => [json_decode($employee->user_reporting)[1]]
                    ]);
                }
            }

            DB::commit();

            UserCreatedEvent::dispatch($user->id);

            return redirect()->route('freelancer.index')->with('success', 'Employee created successfully');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function edit($id){
        $id = decrypt($id);
        $title     = "Freelancer Edit";
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
        $professions = Profession::where('status',1)->select('id','name')->get();

        $freelancer    = Freelancer::find($id);
        if(!$freelancer){
            return redirect()->back()->with('error', 'Freelancer not found');
        }

        $selected['country_id']   = $freelancer->user->userAddress->country_id??1;
        $selected['division_id']  = $freelancer->user->userAddress->division_id??1;
        $selected['district_id']  = $freelancer->user->userAddress->district_id??1;
        $selected['upazila_id']   = $freelancer->user->userAddress->upazila_id??1;
        $selected['union_id']     = $freelancer->user->userAddress->union_id??1;
        $selected['village_id']   = $freelancer->user->userAddress->village_id??1;

        return view('freelancer.freelancer_edit', compact('professions','title','countries','divisions','districts','upazilas','unions','villages','maritalStatuses','religions','bloodGroups','genders','banks','mobileBanks','freelancer','selected','nationalites'));
    }

    public function update(Request $request, $id){

        $validator = Validator::make($request->all(), [
            'full_name'                 => 'required|string|max:255',
            'marital_status'            => 'nullable',
            'profession'                => 'required|numeric|exists:professions,id',
            'dob'                       => 'nullable',
            'card_id'                   => 'nullable|string',
            'religion'                  => 'required|numeric',
            'blood_group'               => 'nullable|numeric',
            'gender'                    => 'required',
            'phone2'                    => 'nullable|string|max:15',
            'office_email'              => 'nullable|email',
            'email'                     => 'nullable|email',
            'imo_whatsapp_number'       => 'nullable|string',
            'facebook_id'               => 'nullable|string',
            'emergency_contact_name'    => 'nullable|string',
            'emergency_person_number'   => 'nullable|string',
            'division'                  => 'nullable|numeric|exists:divisions,id',
            'district'                  => 'nullable|numeric|exists:districts,id',
            'upazila'                   => 'nullable|numeric|exists:upazilas,id',
            'union'                     => 'nullable|numeric|exists:unions,id',
            'village'                   => 'nullable|numeric|exists:villages,id',
            'address'                   => 'nullable|string',
            'father_name'               => 'nullable|string',
            'father_phone'              => 'nullable|string|max:15',
            'mother_name'               => 'nullable|string',
            'mother_phone'              => 'nullable|string|max:15',
            'spouse_name'               => 'nullable|string',
            'spouse_phone'              => 'nullable|string|max:15',
            'bank'                      => 'nullable|numeric|exists:banks,id',
            'branch'                    => 'nullable|string',
            'account_number'            => 'nullable|string',
            'account_holder_name'       => 'nullable|string',
            'mobile_bank'               => 'nullable|numeric|exists:banks,id',
            'mobile_bank_number'        => 'nullable|string|max:15',
            'passport_issue_date'       => 'nullable',
            'passport_expire_date'      => 'nullable',
            'tin_number'                => 'nullable|string',
            'profile_image'             => 'image|max:2048',
            'nid_file'                  => 'image|max:2048',
            'birth_certificate_file'    => 'image|max:2048',
            'upload_passport'           => 'image|max:2048',
            // 'at_least_one_field' => [
            //     'sometimes', new AtLeastOneFilledRule('nid', 'birth_certificate_number', 'passport_number'),
            // ],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator)->with('error', $validator->errors()->first());
        }
        DB::beginTransaction();
        $freelancer = Freelancer::find($id);
        $user = $freelancer->user;
        if(!$user){
            return redirect()->back()->with('error', 'User Not Found');
        }
        try {
            $user->update([
                'user_id'       => $request->freelancer_id,
                'phone'         => get_phone($request->phone1),
                'name'          => $request->full_name,
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
                'post_code'     => $request->post_code,
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

            $freelancer->profession_id = $request->profession;
            $freelancer->save();

            DB::commit();
            return redirect()->route('freelancer.index')->with('success', 'Freelancer Updated successfully');
        } catch (Exception $e) {
            dd($e->getMessage());
            DB::rollback();
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function freelancerDelete($id){
        try{
            $data  = Freelancer::find($id);
            $data->delete();
            return response()->json(['success' => 'Freelancer Deleted'],200);
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()],500);
        }
    }

    public  function freelancerPrint($id) {
        $title     = "Freelancer Print";
        $countries = $this->getCachedCountries();
        $divisions = $this->getCachedDivisions();
        $districts = $this->getCachedDistricts();
        $upazilas  = $this->getCachedUpazilas();
        $unions    = $this->getCachedUnions();
        $villages  = $this->getCachedVillages();
        $professions = Profession::where('status',1)->select('id','name')->get();
        $maritalStatuses = $this->maritalStatus();
        $religions = $this->religion();
        $bloodGroups = $this->bloodGroup();
        $genders = $this->gender();
        $banks = Bank::where('status',1)->where('type',0)->select('id','name')->get();
        $mobileBanks = Bank::where('status',1)->where('type',1)->select('id','name')->get();
        $zones = Zone::where('status',1)->select('id','name')->get();
        $areas = Area::where('status',1)->select('id','name')->get();
        $freelancer    = Freelancer::find($id);
        $selected['country_id']   = $freelancer->user->userAddress->country_id;
        $selected['division_id']  = $freelancer->user->userAddress->division_id;
        $selected['district_id']  = $freelancer->user->userAddress->district_id;
        $selected['upazila_id']   = $freelancer->user->userAddress->upazila_id;
        $selected['union_id']     = $freelancer->user->userAddress->union_id;
        $selected['village_id']   = $freelancer->user->userAddress->village_id;

        return view('freelancer.freelancer_print', compact('title','countries','divisions','districts','upazilas','unions','villages','professions','maritalStatuses','religions','bloodGroups','genders','banks','mobileBanks','zones','areas','freelancer','selected'));
    }
}
