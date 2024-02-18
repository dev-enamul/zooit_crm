<?php

namespace App\Http\Controllers;

use App\Enums\Priority;
use App\Enums\ProspectingMedia;
use App\Models\ColdCalling;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Profession;
use App\Models\Prospecting;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProspectingController extends Controller
{
    public function prospectingMedia()
    {
        return ProspectingMedia::values();
    }

    public function priority()
    {
        return Priority::values();
    }

    // public function index(Request $request)
    // { 
    //     $professions = Profession::all();  
    //     $my_all_employee = my_all_employee(auth()->user()->id);
    //     $employee_data = Customer::whereIn('ref_id', $my_all_employee)->get(); 
    //     $employees = User::whereIn('id', $my_all_employee)->get();

    //     if(isset($request->employee) && !empty($request->employee)){
    //         $user_id = (int)$request->employee;
    //     }else{
    //         $user_id = Auth::user()->id;
    //     } 
      
    //     $user_employee = my_all_employee($user_id);
    //     $prospectings = Prospecting::where('status',1)->whereHas('customer', function($q) use($user_employee){ 
    //         $q->whereIn('ref_id', $user_employee);
    //     }); 

    //     if(isset($request->date) && !empty($request->date)){ 
    //         $date_parts = explode(" - ", $request->date); 
    //         $start_date = $date_parts[0];
    //         $end_date = $date_parts[1]; 
             
    //         $start_date = \Carbon\Carbon::createFromFormat('m/d/Y', $start_date)->format('Y-m-d');
    //         $end_date = \Carbon\Carbon::createFromFormat('m/d/Y', $end_date)->format('Y-m-d'); 
    //         $prospectings = $prospectings->whereBetween('created_at', [$start_date, $end_date]);
            
    //      }

    //      if(isset($request->profession) && !empty($request->profession)){
    //         $profession = (int)$request->profession;
    //         $prospectings = $prospectings->whereHas('customer', function($q) use($profession){ 
    //             $q->where('profession_id', $profession);
    //         });
    //      } 
    //     $prospectings = $prospectings->get();
        
    //     $prospecting_unapproved = Prospecting::where('status', 0)->where('created_by',1)->get();
    //     $filter =  $request->all();
    //     return view('prospecting.prospecting_list', compact('prospectings','employee_data','professions','employees','filter','prospecting_unapproved'));
    // }

    public function index(Request $request)
{ 
    $professions = Profession::all();  
    $my_all_employee = my_all_employee(auth()->user()->id);
    $employee_data = Customer::whereIn('ref_id', $my_all_employee)->get(); 
    $employees = User::whereIn('id', $my_all_employee)->get();

    if(isset($request->employee) && !empty($request->employee)){
        $user_id = (int)$request->employee;
    }else{
        $user_id = Auth::user()->id;
    } 

    $user_employee = my_all_employee($user_id);
    $prospectings = Prospecting::whereHas('customer', function($q) use($user_employee){ 
        $q->whereIn('ref_id', $user_employee);
    }); 

    if(isset($request->date) && !empty($request->date)){ 
        $date_parts = explode(" - ", $request->date); 
        $start_date = $date_parts[0];
        $end_date = $date_parts[1]; 
         
        $start_date = \Carbon\Carbon::createFromFormat('m/d/Y', $start_date)->format('Y-m-d');
        $end_date = \Carbon\Carbon::createFromFormat('m/d/Y', $end_date)->format('Y-m-d'); 
        $prospectings = $prospectings->whereBetween('created_at', [$start_date, $end_date]);
        
    }

    if(isset($request->profession) && !empty($request->profession)){
        $profession = (int)$request->profession;
        $prospectings = $prospectings->whereHas('customer', function($q) use($profession){ 
            $q->where('profession_id', $profession);
        });
    } 

    // Get all prospectings with status 1 and those unapproved with status 0
    $prospectings = $prospectings->with('employee','customer.user')->where(function ($query) {
        $query->where('status', 1)
              ->orWhere(function ($subquery) {
                  $subquery->where('status', 0)
                           ->where('created_by', Auth::user()->id);
              });
    })->get();

    $filter =  $request->all();
    return view('prospecting.prospecting_list', compact('prospectings','employee_data','professions','employees','filter'));
}


    public function create(Request $request)
    {
        $title = 'Prospecting Entry';
        $user_id   = Auth::user()->id; 
        $my_all_employee = my_all_employee($user_id);
        $customers = Customer::whereIn('ref_id', $my_all_employee)->get();
        $employees = User::whereIn('id', $my_all_employee)->get();
        $prospectingMedias = $this->prospectingMedia();
        $priorities = $this->priority();
        $selected_data = 
        [
            'employee' => Auth::user()->id,
            'priority' => Priority::Regular,
            'media'    => ProspectingMedia::Phone,
        ];

        if ($request->has('customer')) {
            $selected_data['customer'] = $request->customer;
        }
    
        return view('prospecting.prospecting_save', compact('customers','prospectingMedias','priorities','title','employees','selected_data'));
    }    


    public function save(Request $request, $id = null)
    {
        $validator = Validator::make($request->all(), [
            'media'         => 'required',
            'priority'      => 'required',
            'customer'      => 'required',
            'employee'      => 'required',
            'remark'        => 'nullable|string|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator)->with('error', $validator->errors()->first());
        }

        if (!empty($id)) {
            $prospecting = Prospecting::find($id);
            $prospecting->update([
                'media'         => $request->media,
                'priority'      => $request->priority,
                'remark'        => $request->remark,
                'customer_id'   => $request->customer,
                'employee_id'   => $request->employee,
                'updated_by'    => auth()->id(),
                'updated_at'    => now(),
            ]);
            return redirect()->route('prospecting.index')->with('success','Prospecting update successfully');

        } else {
            $prospecting = new Prospecting();
            $prospecting->media         = $request->media;
            $prospecting->priority      = $request->priority;
            $prospecting->remark        = $request->remark;
            $prospecting->customer_id   = $request->customer;
            $prospecting->employee_id   = $request->employee;
            $prospecting->status        = 0;
            $prospecting->created_by    = auth()->id();
            $prospecting->created_at    = now();
            $prospecting->save();

            if($prospecting) {
                $customer = Customer::find($request->customer);
                $customer->status = 1;
                $customer->save();
            }
            return redirect()->route('prospecting.index')->with('success','Prospecting create successfully');
        }
    }

    public function edit(string $id)
    {
        $title = 'Prospecting Edit';
        $prospecting = Prospecting::find($id);
        $user_id   = Auth::user()->id; 
        $my_all_employee = my_all_employee($user_id);
        $customers = Customer::whereIn('ref_id', $my_all_employee)->get();
        $employees = User::whereIn('id', $my_all_employee)->get();
        $prospectingMedias = $this->prospectingMedia();
        $priorities = $this->priority();

        return view('prospecting.prospecting_save', compact('prospecting','customers','employees','prospectingMedias','priorities','title'));
    }

    public function prospectingDelete($id){
        try{
            $data  = Prospecting::find($id);
            $data->delete();
            return response()->json(['success' => 'Prospecting Deleted'],200);
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()],500);
        }
    } 

    public function prospecting_approve(){ 
        $user_id   = Auth::user()->id; 
        $my_employee = my_employee($user_id);  
        $prospectings = Prospecting::where('approve_by', null)->whereIn('employee_id',$my_employee)->get(); 
        return view('prospecting.prospecting_approve', compact('prospectings'));
    }
}
