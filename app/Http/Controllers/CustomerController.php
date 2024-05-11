<?php

namespace App\Http\Controllers;

use App\DataTables\CustomersDataTable;
use App\Enums\BloodGroup;
use App\Enums\Gender;
use App\Enums\MaritualStatus;
use App\Enums\Nationality;
use App\Enums\Religion;
use App\Models\ApproveSetting;
use App\Models\Area;
use App\Models\Bank;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Notification;
use App\Models\Profession;
use App\Models\ReportingUser;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\UserContact;
use App\Models\UserFamily;
use App\Models\UserId;
use App\Models\UserTransaction;
use App\Models\Zone;
use App\Rules\AtLeastOneFilledRule;
use App\Traits\AreaTrait;
use App\Traits\ImageUploadTrait;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
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

    public function index(CustomersDataTable $dataTable, Request $request)
    {  
        $title = 'Prospecting List'; 
        $date = $request->date??null;
        $status = $request->status??0;
        $start_date = Carbon::parse($date ? explode(' - ',$date)[0] : date('Y-m-01'))->format('Y-m-d');
        $end_date = Carbon::parse($date ? explode(' - ',$date)[1] : date('Y-m-t'))->format('Y-m-d'); 
        if(isset($request->employee) && $request->employee != null){
            $employee = User::find($request->employee);
        }else{
            $employee = User::find(auth()->user()->id);
        } 
        return $dataTable->render('customer.customer_list', compact('title','employee','status','start_date','end_date'));
    }

    public function create(){
        $title     = "Customer Create"; 
        $divisions = $this->getCachedDivisions(); 
        $districts = $this->getCachedDistricts();
        $upazilas  = $this->getCachedUpazilas();
        $unions    = $this->getCachedUnions();
        $villages  = $this->getCachedVillages();

        $nationalites = $this->nationality(); 
        $maritalStatuses = $this->maritalStatus();
        $religions = $this->religion();
        $bloodGroups = $this->bloodGroup();
        $areas = Area::where('status',1)->select('id','name')->get();
        $zones = Zone::where('status',1)->select('id','name')->get();
        $genders = $this->gender(); 
        $banks = Bank::where('status',1)->where('type',0)->select('id','name')->get();
        $mobileBanks = Bank::where('status',1)->where('type',1)->select('id','name')->get(); 
        $professions = Profession::where('status',1)->select('id','name')->get(); 
        
        return view('customer.customer_create', compact(
            'title', 
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
            'nationalites', 
            'professions', 
            'areas',
            'zones'
        ));
    }

    public function save(Request $request, $id = null)
    {
        $validator = Validator::make($request->all(), [
            'full_name'                 => 'required|string|max:255', 
            'marital_status'            => 'nullable',
            'profession'                => 'required|numeric|exists:professions,id',
            'dob'                       => 'nullable',
            'card_id'                   => 'nullable|string',
            'religion'                  => 'required|numeric',
            'blood_group'               => 'nullable|numeric',
            'gender'                    => 'required|in:1,2,3',
            'phone1'                    => 'required|string|max:15',
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
       
        try { 
            $old_user = User::where('phone', $request->phone1)->withTrashed()->first();
            $approve_setting = ApproveSetting::where('name','customer')->first();  
            $is_admin = Auth::user()->hasPermission('admin'); 
            if($approve_setting->status == 0 || $is_admin){ 
                $approve_by = auth()->user()->id;
            }else{
                $approve_by = null;
                // $auth_user = Auth::user(); 
                // if(count(json_decode($auth_user->user_reporting))>1){
                //     Notification::store([
                //         'title'         => 'Customer approval request',
                //         'content'       => $auth_user->name.' has created a customer please approve as soon as possible',
                //         'link'          => route('customer.approve'),
                //         'created_by'    => auth()->user()->id,  
                //         'user_id'       => json_decode($auth_user->user_reporting)[1]
                //     ]);
                // }
            }  
            if ($old_user) {
                return redirect()->back()->withInput()->with('error', 'Customer already exists');
                // $old_user->deleted_at = null;
                // $old_user->deleted_by = null;
                // $old_user->updated_at = now();
                // $old_user->save();
                // Customer::create([
                //     'user_id'       => $old_user->id,
                //     'customer_id'   => User::generateNextCustomerId(),
                //     'profession_id' => $request->profession,
                //     'name'          => $request->full_name,
                //     'ref_id'        => $request->reporting_user, 
                //     'status'        => 0,
                //     'created_at'    => now(),
                //     'approve_by'    => $approve_by,
                //     'created_by'    => auth()->user()->id,
                // ]);  
                // return redirect()->route('customer.index')->with('success', 'Customer added successfully');
            } 

            $user = User::create([ 
                'name'          => $request->full_name,
                'phone'         => get_phone($request->phone1),
                'password'      => bcrypt('123456'),
                'user_type'     => 3,
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
                'passport_exp_date'         => date('Y-m-d', strtotime($request->passport_expire_date)),
                'passport_image'            => $upload_passport ?? null,
                'tin_number'                => $request->tin_number,
                'created_at'                => now(),
            ];
            UserId::create($user_documents); 
            $customer_data = [
                'customer_id'      =>  User::generateNextCustomerId(),
                'user_id'           => $user->id,
                'profession_id'     => $request->profession, 
                'name'              => $request->full_name, 
                'ref_id'            => $request->reporting_user,
                'status'            => 0,
                'created_at'        => now(),
                'created_by'        => auth()->user()->id,
                'approve_by'        => $approve_by,
            ];  
            Customer::create($customer_data);   
            

            // Notification  
            

            DB::commit(); 
            return redirect()->route('customer.index')->with('success', 'Customer created successfully');
        } catch (Exception $e) {  
            dd($e->getMessage()); 
            DB::rollback();
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
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
            'gender'                    => 'required|in:1,2,3', 
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
       
        try {  
            $customer = Customer::find($id);
            $user = $customer->user;

            if($user==null){
                return redirect()->back()->with('Invalid Customer');
            }   
            $user->update([ 
                'name'          => $request->full_name,  
                'user_type'     => 3,
                'marital_status'=> $request->marital_status,
                'dob'           => date('Y-m-d', strtotime($request->dob)),
                'finger_id'     => $request->card_id,
                'religion'      => $request->religion,
                'blood_group'   => $request->blood_group,
                'gender'        => $request->gender,
                'nationality'   => $request->nationality, 
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

            $customer_data = [  
                'profession_id'     => $request->profession, 
                'name'              => $request->full_name,
                'ref_id'            => $request->reporting_user,
            ];  
            $customer->update($customer_data);    
            DB::commit(); 
            return redirect()->route('customer.index')->with('success', 'Customer updated successfully');
        } catch (Exception $e) {   
            DB::rollback();
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function customerSearch(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'division'       => 'nullable',
            'district'       => 'nullable',
            'upazila'        => 'nullable',
            'union'          => 'nullable',
            'village'        => 'nullable',
            'status'         => 'nullable|in:1,0',
            'customer'       => 'nullable|numeric|exists:freelancers,id',
            'profession'     => 'nullable|numeric|exists:professions,id',
            'daterange'      => 'nullable',
            'employee'       => 'nullable'
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errorMessage = implode('<br>', $errors);
            
            if ($validator->fails()) {
                return redirect()->back()->withInput()->withErrors($validator)->with('error', 'Validation failed.');
            }
        }

        try{
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $division_id    = $request->division;
                $district_id    = $request->district;
                $upazila_id     = $request->upazila;
                $union_id       = $request->union;
                $village_id     = $request->village;
                $status         = $request->status;
                $customer_id    = $request->customer;
                $profession_id  = $request->profession;
                $daterange      = $request->daterange;
                $employee_id    = $request->employee;

                $divisions      = $this->getCachedDivisions();
                $districts      = $this->getCachedDistricts();
                $upazilas       = $this->getCachedUpazilas();
                $unions         = $this->getCachedUnions();
                $villages       = $this->getCachedVillages();
                $professions    = Profession::where('status',1)->select('id','name')->get();
                $customers      = Customer::where('status', 1)->get();
                $employees      = Employee::where('status',1)->get();

                $selected['division_id']   = $division_id;
                $selected['district_id']   = $district_id;
                $selected['upazila_id']    = $upazila_id;
                $selected['union_id']      = $union_id;
                $selected['village_id']    = $village_id;
                $selected['status']        = $status;
                $selected['customer_id']   = $customer_id;
                $selected['profession_id'] = $profession_id;
                $selected['employee_id']   = $employee_id;
                $selected['daterange']     = $daterange;

                $dateParts      = explode(' - ', $daterange);
                $fromDate       = \Carbon\Carbon::createFromFormat('m/d/Y', $dateParts[0])->startOfDay();
                $toDate         = \Carbon\Carbon::createFromFormat('m/d/Y', $dateParts[1])->endOfDay();
                $customer_id    = $customer_id;
                $customerId     = Customer::where('id',$customer_id)->pluck('user_id')->first();
                $employeeId     = Employee::where('id',$employee_id)->pluck('user_id')->first();
                $customers = Customer::where('status', 1) 
                ->whereHas('user.userAddress', function ($query) use ($division_id, $district_id, $village_id, $union_id, $upazila_id) {
                        if ($division_id != null) {
                            $query->where('division_id', $division_id);
                        }
                        if ($district_id != null) {
                            $query->where('district_id', $district_id);
                        }
                        if ($village_id != null) {
                            $query->where('village_id', $village_id);
                        }
                        if ($union_id != null) {
                            $query->where('union_id', $union_id);
                        }
                        if ($upazila_id != null) {
                            $query->where('upazila_id', $upazila_id);
                        }
                    })
                    ->whereBetween('created_at', [$fromDate, $toDate]);
                if ($customer_id != null) {
                    $customers = $customers->where('id', $customer_id);
                }
                if ($profession_id != null) {
                    $customers = $customers->where('profession_id', $profession_id);
                }
                if ($status != null) {
                    $customers = $customers->where('status', $status);
                }

                $datas = $customers->get();
                return view('customer.customer_list', compact('employees','professions','customers','datas','divisions','districts','upazilas','unions','villages','selected'));
            }
        }
        catch (\Throwable $th) { 
            return redirect()->route('product.edit')->with('error', 'Something went wrong!');
         }
    }

    public function edit($id){
        $id = decrypt($id);
        $title     = "Customer Edit";
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
         
        $customer = Customer::find($id);
        $selected['country_id']   = $customer->user->userAddress->country_id??1;
        $selected['division_id']  = $customer->user->userAddress->division_id??1;
        $selected['district_id']  = $customer->user->userAddress->district_id??1;
        $selected['upazila_id']   = $customer->user->userAddress->upazila_id??1;
        $selected['union_id']     = $customer->user->userAddress->union_id??1;
        $selected['village_id']   = $customer->user->userAddress->village_id??1;
 
        return view('customer.customer_edit', compact(
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
            'nationalites', 
            'professions',
            'customer',
            'selected'
        ));
    }

    public function customerDelete($id){ 
        $id = decrypt($id);
        try{ 
            $data  = Customer::find($id);
            $data->delete();
            return response()->json(['success' => 'Customer Deleted'],200);
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()],500);
        }
    }

    public  function customerPrint($id) {
        $title     = "Customer Edit";
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
        $customer = Customer::find($id);
        $selected['country_id']   = $customer->user->userAddress->country_id;
        $selected['division_id']  = $customer->user->userAddress->division_id;
        $selected['district_id']  = $customer->user->userAddress->district_id;
        $selected['upazila_id']   = $customer->user->userAddress->upazila_id;
        $selected['union_id']     = $customer->user->userAddress->union_id;
        $selected['village_id']   = $customer->user->userAddress->village_id;

        return view('customer.customer_print', compact('title','countries','divisions','districts','upazilas','unions','villages','professions','maritalStatuses','religions','bloodGroups','genders','banks','mobileBanks','zones','areas','customer','selected'));
    }  

    public function customer_approve(){
        $my_customer = my_employee(auth()->user()->id);
        $customers = Customer::where('approve_by',null)->whereIn('created_by',$my_customer)->get();
        return view('customer.customer_approve',compact('customers'));
    }

    public function customer_approve_save(Request $request) {
        if($request->has('customer_id') && $request->customer_id !== '' & $request->customer_id !== null) {
            DB::beginTransaction();
            try {
                foreach ($request->customer_id as $key => $customer_id) {
                    $customer = Customer::find($customer_id);
                    $customer->approve_by = Auth::user()->id;
                    $customer->save();
                }
                DB::commit();
                return redirect()->route('customer.index')->with('success', 'Approved Customer Successfully!');
            } catch (Exception $e) {
                DB::rollback();
                return redirect()->back()->withInput()->with('error', $e->getMessage());
            }
            
        } else {
            return redirect()->route('prospecting.approve')->with('error', 'Something went wrong!');
        }
    } 
    public function customerDetails($id){
        $id = decrypt($id);
        $customer = Customer::find($id);
        $user = $customer->user;
    
        return view('customer.customer_details',compact('customer','user'));
    }
    
}
