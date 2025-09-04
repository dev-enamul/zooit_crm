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
use App\Models\CompanyType;
use App\Models\Country;
use App\Models\Customer;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\FindMedia;
use App\Models\FollowUp;
use App\Models\Lead;
use App\Models\Meeting;
use App\Models\Notification;
use App\Models\Profession;
use App\Models\Project;
use App\Models\Rejection;
use App\Models\Service;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\UserContact;
use App\Models\UserFamily;
use App\Models\UserId;
use App\Models\UserTransaction;
use App\Models\Zone;
use App\Traits\AreaTrait;
use App\Traits\ImageUploadTrait;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller {
    use AreaTrait;
    use ImageUploadTrait;

    public function maritalStatus() {
        return MaritualStatus::values();
    }

    public function religion() {
        return Religion::values();
    }

    public function bloodGroup() {
        return BloodGroup::values();
    }

    public function gender() {
        return Gender::values();
    } 
    
    public function nationality() {
        return Nationality::values();
    }

    public function index(CustomersDataTable $dataTable, Request $request) {
        $title      = 'Prospecting List';
        $date       = $request->date ?? null;
        $status     = $request->status ?? 0;
        $start_date = Carbon::parse($date ? explode(' - ', $date)[0] : date('Y-m-01'))->format('Y-m-d');
        $end_date   = Carbon::parse($date ? explode(' - ', $date)[1] : date('Y-m-t'))->format('Y-m-d');
        if (isset($request->employee) && $request->employee != null) {
            $employee = User::find($request->employee);
        } else {
            $employee = User::find(auth()->user()->id);
        } 
 
        return $dataTable->render('customer.customer_list', compact('title', 'employee', 'status', 'start_date', 'end_date'));
    }

    public function create() { 
        $title     = "Lead Save";   

        $services = Service::select('id','service')->get();
        $company_types = CompanyType::where('status',1)->select('id','name')->get();
        $find_medias = FindMedia::where('status',1)->get();
        $designations = Designation::where('status',1)->get();
        $countries = Country::get();

        return view('customer.customer_create', compact(
            'title', 
            'services',
            'company_types',
            'find_medias',
            'designations',
            'countries'
        ));
    } 

    public function edit($id) {
        $id = decrypt($id); 
        $title     = "Lead Update";
        $services = Service::select('id','service')->get();
        $company_types = CompanyType::where('status',1)->select('id','name')->get();
        $find_medias = FindMedia::where('status',1)->get();
        $designations = Designation::where('status',1)->get();
        $countries = Country::get();
        $user = Customer::find($id); 

        return view('customer.customer_create', compact(
            'title',
            'services',
            'company_types',
            'find_medias',
            'designations',
            'countries',
            'user'
        ));
    }
    

    public function save(Request $request) {
        $validator = Validator::make($request->all(), [
            'full_name'           => 'required|string|max:255',
            'phone'               => 'required|string|max:25',
            'company_type'        => 'required|in:1,2',
            'find_media_id'       => 'nullable|integer',
            'contact_person_name' => 'nullable|string|max:255',
            'designation_id'      => 'nullable|integer',
            'service_id'          => 'nullable|integer',
            'remark'              => 'nullable|string|max:500',
            'address'             => 'nullable|string',
        ]); 
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator)->with('error', $validator->errors()->first());
        }  
        DB::beginTransaction(); 
        try { 
            if(isset($request->id)  && $request->id != null){
                $id = $request->id;
                $customer = Customer::find($id); 
                $user = $customer->user;
            }  

            if(isset($request->phone) && $request->phone ==null){
                $phone = get_phone($request->phone);
                $user = User::where('phone',$phone)->first();
            }

            if(isset($user)){
                $user->update([
                    'name'          => $request->full_name,  
                    'phone'         =>  get_phone($request->phone),
                ]);   

                $user->userAddress->update([ 
                    'address'  => $request->address,
                ]);  

                $customer->update([  
                    'service_id'    => $request->service_id,
                    'find_media_id' => $request->find_media_id,
                    'type'          => $request->company_type,
                    'remark'        => $request->remark, 
                ]);

            }else{
                $user = User::create([
                    'name'           => $request->full_name,
                    'phone'          => get_phone($request->phone),
                    'password'       => bcrypt('123456'), 
                    'user_type'      => 3,  
                    'status'         => 1,
                    'created_by'     => auth()->user()->id,
                ]);

                UserContact::create([
                    'user_id'        => $user->id,
                    'name'           => $request->contact_person_name ?? $request->full_name,
                    'type'           => $request->company_type,
                    'designation_id' => $request->designation_id,
                    'phone'          => get_phone($request->phone),
                    'created_at'     => now(),
                ]);
    
                UserAddress::create([
                    'user_id' => $user->id,
                    'address'  => $request->address,
                ]);
         
                Customer::create([
                    'visitor_id'   => User::generateNextVisitorId(),
                    'user_id'       => $user->id, 
                    'ref_id'        => Auth::user()->id,
                    'service_id'    => $request->service_id,
                    'find_media_id' => $request->find_media_id,
                    'type'          => $request->company_type,
                    'remark'        => $request->remark,
                    'status'        => 0, 
                    'created_by'    => auth()->user()->id, 
                ]);

            }  

           
    
            DB::commit(); 
            return redirect()->route('customer.index')->with('success', 'Customer created successfully');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }
     
    public function customerSearch(Request $request) {
        $validator = Validator::make($request->all(), [
            'division'   => 'nullable',
            'district'   => 'nullable',
            'upazila'    => 'nullable',
            'union'      => 'nullable',
            'village'    => 'nullable',
            'status'     => 'nullable|in:1,0',
            'customer'   => 'nullable|numeric|exists:freelancers,id',
            'profession' => 'nullable|numeric|exists:professions,id',
            'daterange'  => 'nullable',
            'employee'   => 'nullable',
        ]);
        if ($validator->fails()) {
            $errors       = $validator->errors()->all();
            $errorMessage = implode('<br>', $errors);

            if ($validator->fails()) {
                return redirect()->back()->withInput()->withErrors($validator)->with('error', 'Validation failed.');
            }
        }

        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $division_id   = $request->division;
                $district_id   = $request->district;
                $upazila_id    = $request->upazila;
                $union_id      = $request->union;
                $village_id    = $request->village;
                $status        = $request->status;
                $customer_id   = $request->customer;
                $profession_id = $request->profession;
                $daterange     = $request->daterange;
                $employee_id   = $request->employee;

                $divisions   = $this->getCachedDivisions();
                $districts   = $this->getCachedDistricts();
                $upazilas    = $this->getCachedUpazilas();
                $unions      = $this->getCachedUnions();
                $villages    = $this->getCachedVillages();
                $professions = Profession::where('status', 1)->select('id', 'name')->get();
                $customers   = Customer::where('status', 1)->get();
                $employees   = Employee::where('status', 1)->get();

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

                $dateParts   = explode(' - ', $daterange);
                $fromDate    = \Carbon\Carbon::createFromFormat('m/d/Y', $dateParts[0])->startOfDay();
                $toDate      = \Carbon\Carbon::createFromFormat('m/d/Y', $dateParts[1])->endOfDay();
                $customer_id = $customer_id;
                $customerId  = Customer::where('id', $customer_id)->pluck('user_id')->first();
                $employeeId  = Employee::where('id', $employee_id)->pluck('user_id')->first();
                $customers   = Customer::where('status', 1)
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
                return view('customer.customer_list', compact('employees', 'professions', 'customers', 'datas', 'divisions', 'districts', 'upazilas', 'unions', 'villages', 'selected'));
            }
        } catch (\Throwable $th) {
            return redirect()->route('product.edit')->with('error', 'Something went wrong!');
        }
    } 

    public function customerDelete($id) {
        $id = decrypt($id);
        try {
            $followup = FollowUp::where('customer_id',$id)->first();
            if($followup){
                $followup->delete();
            } 
            $rejection = Rejection::where('customer_id',$id)->first();
            if($rejection){
                $rejection->delete();
            } 

            $meeting = Meeting::where('customer_id',$id)->first();
            if($meeting){
                $meeting->delete();
            }
            $data = Customer::find($id);
            
            $data->delete();
            return response()->json(['success' => 'Customer Deleted'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function customerPrint($id) {
        $title                   = "Customer Edit";
        $countries               = $this->getCachedCountries();
        $divisions               = $this->getCachedDivisions();
        $districts               = $this->getCachedDistricts();
        $upazilas                = $this->getCachedUpazilas();
        $unions                  = $this->getCachedUnions();
        $villages                = $this->getCachedVillages();
        $professions             = Profession::where('status', 1)->select('id', 'name')->get();
        $maritalStatuses         = $this->maritalStatus();
        $religions               = $this->religion();
        $bloodGroups             = $this->bloodGroup();
        $genders                 = $this->gender();
        $banks                   = Bank::where('status', 1)->where('type', 0)->select('id', 'name')->get();
        $mobileBanks             = Bank::where('status', 1)->where('type', 1)->select('id', 'name')->get();
        $zones                   = Zone::where('status', 1)->select('id', 'name')->get();
        $areas                   = Area::where('status', 1)->select('id', 'name')->get();
        $customer                = Customer::find($id);
        $selected['country_id']  = $customer->user->userAddress->country_id;
        $selected['division_id'] = $customer->user->userAddress->division_id;
        $selected['district_id'] = $customer->user->userAddress->district_id;
        $selected['upazila_id']  = $customer->user->userAddress->upazila_id;
        $selected['union_id']    = $customer->user->userAddress->union_id;
        $selected['village_id']  = $customer->user->userAddress->village_id;

        return view('customer.customer_print', compact('title', 'countries', 'divisions', 'districts', 'upazilas', 'unions', 'villages', 'professions', 'maritalStatuses', 'religions', 'bloodGroups', 'genders', 'banks', 'mobileBanks', 'zones', 'areas', 'customer', 'selected'));
    }

    public function customer_approve() {
        $my_customer = my_employee(auth()->user()->id);
        $customers   = Customer::where('approve_by', null)->whereIn('created_by', $my_customer)->get();
        return view('customer.customer_approve', compact('customers'));
    }

    public function customer_approve_save(Request $request) {
        if ($request->has('customer_id') && $request->customer_id !== '' & $request->customer_id !== null) {
            DB::beginTransaction();
            try {
                foreach ($request->customer_id as $key => $customer_id) {
                    $customer             = Customer::find($customer_id);
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
    public function customerDetails($id) {
        $id       = decrypt($id);
        $customer = Customer::find($id);
        $user     = $customer->user;

        return view('customer.customer_details', compact('customer', 'user'));
    }

 
    

}
