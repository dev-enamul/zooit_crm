<?php

namespace App\Http\Controllers;

use App\Enums\BloodGroup;
use App\Enums\Gender;
use App\Models\Freelancer;
use App\Models\Profession;
use App\Traits\AreaTrait;
use App\Traits\ImageUploadTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Enums\MaritualStatus;
use App\Enums\Religion;
use App\Models\Area;
use App\Models\Bank;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\UserContact;
use App\Models\UserFamily;
use App\Models\Zone;
use App\Rules\AtLeastOneFilledRule;
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

    

    public function index(){ 
        $datas       =  Freelancer::where('status',1)->get();
        $countries   = $this->getCachedCountries();
        $divisions   = $this->getCachedDivisions();
        $districts   = $this->getCachedDistricts();
        $upazilas    = $this->getCachedUpazilas();
        $unions      = $this->getCachedUnions();
        $villages    = $this->getCachedVillages();
        $professions = Profession::where('status',1)->select('id','name')->get();
        $freelancers = Freelancer::where('status', 1)->get();
        return view('freelancer.freelancer_list',compact('datas','professions','countries','divisions','districts','upazilas','unions','villages','freelancers'));
    }

    public function create(){
        $title     = "Freelancer Create";
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
        return view('freelancer.freelancer_save', compact('title','countries','divisions','districts','upazilas','unions','villages','professions','maritalStatuses','religions','bloodGroups','genders','banks','mobileBanks','zones','areas'));
    }
    
    public function save(Request $request, $id = null)
    {
        $validator = Validator::make($request->all(), [
            'full_name'                 => 'required|string|max:255',
            'profession'                => 'required|numeric|exists:professions,id',
            'maritual_status'           => 'required|in:1,2,3',
            'dob'                       => 'required|date_format:m/d/Y',
            'card_id'                   => 'nullable|string',
            'religion'                  => 'required|numeric|in:1,2,3,4,5,6,7,8,9,10',
            'blood_group'               => 'required|numeric|in:1,2,3,4,5,6,7,8',
            'gender'                    => 'required|in:1,2',
            'phone1'                    => 'required|string',
            'phone2'                    => 'nullable|string',
            'office_email'              => 'nullable|email',
            'email'                     => 'nullable|email',
            'imo_whatsapp_number'       => 'nullable|string',
            'facebook_id'               => 'nullable|string',
            'emergency_contact_name'    => 'nullable|string',
            'emergency_person_number'   => 'nullable|string',
            'country'                   => 'required|numeric|exists:countries,id',
            'division'                  => 'required|numeric|exists:divisions,id',
            'district'                  => 'required|numeric|exists:districts,id',
            'upazila'                   => 'required|numeric|exists:upazilas,id',
            'union'                     => 'required|numeric|exists:unions,id',
            'village'                   => 'required|numeric|exists:villages,id',
            'address'                   => 'required|string',
            'zone'                      => 'required|numeric|exists:zones,id',
            'area'                      => 'required|numeric|exists:areas,id',
            'father_name'               => 'required|string',
            'father_phone'              => 'nullable|string',
            'mother_name'               => 'required|string',
            'mother_phone'              => 'nullable|string',
            'spouse_name'               => 'nullable|string',
            'spouse_phone'              => 'nullable|string',
            'bank'                      => 'nullable|numeric|exists:banks,id',
            'branch'                    => 'nullable|string',
            'account_number'            => 'nullable|string',
            'account_holder_name'       => 'nullable|string',
            'mobile_bank'               => 'nullable|numeric|exists:banks,id',
            'mobile_bank_number'        => 'nullable|string',
            'passport_expire_date'      => 'nullable|date_format:m/d/Y',
            'tin_number'                => 'nullable|string',
            'profile_image'             => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'nid_file'                  => 'file|mimes:pdf,jpeg,png,jpg|max:2048',
            'birth_certificate_file'    => 'file|mimes:pdf,jpeg,png,jpg|max:2048',
            'upload_passport'           => 'file|mimes:pdf,jpeg,png,jpg|max:2048',
            'at_least_one_field' => [
                'sometimes', new AtLeastOneFilledRule('nid', 'birth_certificate_number', 'passport_number'),
            ],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator)->with('error', 'Validation failed.');
        }
        $user_id = Auth::user()->id;
        // if (!empty($id)) {

        //     $info = Freelancer::find($id);

        //     if (!empty($info)){
        //         $info->name             = $request->name;
        //         $info->total_floor      = $request->total_floor;
        //         $info->google_map       = $request->google_map;
        //         $info->address          = $request->address;
        //         $info->description      = $request->description;
        //         $info->country_id       = $request->country;
        //         $info->division_id      = $request->division;
        //         $info->district_id      = $request->district;
        //         $info->upazila_id       = $request->upazila;
        //         $info->union_id         = $request->union;
        //         $info->village_id       = $request->village; 
        //         $info->status           = 1;
        //         $info->updated_by       = $user_id;
        //         DB::beginTransaction();
        //         try {
        //             $info->save();

        //             // if ($request->hasFile('image')) {
        //             //     $p_images = new ProjectImage();
        //             //     $p_images->project_id = $info->id;
        //             //     $p_images->name =   $this->uploadImage($request, 'image', 'projects', 'public'); 
        //             //     $p_images->save();
        //             // }
        //             DB::commit();
        //             return redirect()->route('product.index')->with('success', 'Project updated successfully');
        //         } catch (Exception $e) {
        //             DB::rollback();
        //             return redirect()->back()->withInput()->with('error', $e->getMessage());
        //         }
        //     }
        //     else{
        //         return  redirect()->back('error', 'Project not found');
        //     }
        // }

        DB::beginTransaction();
        try {

            # Create new User
            $user = User::create([
                'user_id'       => User::generateNextUserId(),
                'name'          => $request->full_name,
                'email'         => isset($request->email) ? $request->email : User::generateNextEmail(),
                'phone'         => $request->phone1,
                'password'      => bcrypt('123456'),
                'user_type'     => 2, #Freelancer
                'marital_status'=> $request->maritual_status,
                'dob'           => date('Y-m-d', strtotime($request->dob)),
                'finger_id'     => $request->card_id,
                'religion'      => $request->religion,
                'blood_group'   => $request->blood_group,
                'gender'        => $request->gender,
                'status'        => 1,
                'created_by'    => $user_id,
            ]);

            if ($request->hasFile('profile_image')) {
                $user->profile_image = $this->uploadImage($request, 'profile_image', 'users', 'public');
                $user->save();
            }

            #Create user address
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
                'personal_phone'            => $request->phone1,
                'office_phone'              => $request->phone2,
                'office_email'              => $request->office_email,
                'personal_email'            => isset($request->email) ? $request->email : User::generateNextEmail(),
                'imo_number'                => $request->imo_whatsapp_number,
                'facebook_id'               => $request->facebook_id,
                'user_contactscol'          => $request->user_contactscol,
                'emergency_contact_person'  => $request->emergency_contact_name,
                'emergency_contact_number'  => $request->emergency_person_number,
                'created_at'                => now(),
            ]);

            #user family

            UserFamily::create([
                'user_id'               => $user->id,
                'father_name'           => $request->father_name,
                'father_mobile'         => $request->father_phone,
                'mother_name'           => $request->mother_name,
                'mother_mobile'         => $request->mother_phone,
                'spouse_name'           => $request->spouse_name,
                'spouse_contact'        => $request->spouse_phone,
                'created_at'            => now(),
            ]);
            
            #freelancer info
            $data = [
                'user_id'                   => $user->id,
                'profession_id'             => $request->profession,
                'designation_id'            => $user->user_type,    #dummy
                'status'                    => 1,
                'created_at'                => now(),
                'last_approve_by'           => $user_id,    #dummy
            ];
            Freelancer::create($data);
 
            DB::commit();
            
            return redirect()->route('freelancer.index')->with('success', 'Freelancer created successfully');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function freelancerSearch(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'division'       => 'required',
            'district'       => 'required',
            'upazila'        => 'sometimes|required',
            'union'          => 'sometimes|required',
            'village'        => 'sometimes|required',
            'status'         => 'required|in:1,0',
            'freelancer'     => 'required|numeric|exists:freelancers,id',
            'profession'     => 'required|numeric|exists:professions,id',
            'daterange'      => 'required',
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
                $freelancer_id  = $request->freelancer;
                $profession_id  = $request->profession;
                $daterange      = $request->daterange;

                $divisions      = $this->getCachedDivisions();
                $districts      = $this->getCachedDistricts();
                $upazilas       = $this->getCachedUpazilas();
                $unions         = $this->getCachedUnions();
                $villages       = $this->getCachedVillages();
                $professions    = Profession::where('status',1)->select('id','name')->get();
                $freelancers    = Freelancer::where('status', 1)->get();

                $selected['division_id']   = $division_id;
                $selected['district_id']   = $district_id;
                $selected['upazila_id']    = $upazila_id;
                $selected['union_id']      = $union_id;
                $selected['village_id']    = $village_id;
                $selected['status']        = $status;
                $selected['freelancer_id'] = $freelancer_id;
                $selected['profession_id'] = $profession_id;
                $selected['daterange']     = $daterange;

                $dateParts      = explode(' - ', $daterange);
                $fromDate       = \Carbon\Carbon::createFromFormat('m/d/Y', $dateParts[0])->startOfDay();
                $toDate         = \Carbon\Carbon::createFromFormat('m/d/Y', $dateParts[1])->endOfDay();
                $freelancer_id  = $freelancer_id;
                $freelancerId   = Freelancer::where('id',$freelancer_id)->pluck('user_id')->first();
                
                $datas = Freelancer::where('status', 1)
                                ->where('profession_id', $profession_id)
                                ->where('user_id',  $freelancerId)
                                ->whereHas('user.userAddress', function ($query) use ($division_id, $district_id, $village_id, $union_id, $upazila_id) {
                                    $query->where('division_id', $division_id)
                                          ->where('district_id', $district_id)
                                          ->where('village_id', $village_id)
                                          ->where('union_id', $union_id)
                                          ->where('upazila_id', $upazila_id);
                                })
                                ->whereBetween('created_at', [$fromDate, $toDate])
                                ->where('status', $status)
                                ->get();
                return view('freelancer.freelancer_list', compact('professions','freelancers','datas','divisions','districts','upazilas','unions','villages','selected'));
            }
        }
        catch (\Throwable $th) {
            dd( $th);
            return redirect()->route('product.edit')->with('error', 'Something went wrong!');
         }
    }

    public function edit($id){
        $title     = "Freelancer Edit";
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

        return view('freelancer.freelancer_save', compact('title','countries','divisions','districts','upazilas','unions','villages','professions','maritalStatuses','religions','bloodGroups','genders','banks','mobileBanks','zones','areas','freelancer','selected'));
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
}
