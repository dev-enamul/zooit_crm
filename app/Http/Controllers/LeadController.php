<?php

namespace App\Http\Controllers;

use App\Enums\Priority;
use App\Models\Customer;
use App\Models\Lead;
use App\Models\Profession;
use App\Models\Project;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LeadController extends Controller
{

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
        $leads = Lead::whereHas('customer', function($q) use($user_employee){ 
            $q->whereIn('ref_id', $user_employee);
        }); 

         if(isset($request->profession) && !empty($request->profession)){
            $profession = (int)$request->profession;
            $leads = $leads->whereHas('customer', function($q) use($profession){ 
                $q->where('profession_id', $profession);
            });
         } 
         $leads = $leads->get();  
         $filter =  $request->all();
        return view('lead.lead_list', compact('leads','employee_data','professions','employees','filter'));
    }
    public function priority()
    {
        return Priority::values();
    }

    public function create()
    {
        $title = 'Lead Entry';
        $user_id   = Auth::user()->id; 
        $my_all_employee = my_all_employee($user_id);
        $customers = Customer::whereIn('ref_id', $my_all_employee)->get();
        $projects = Project::where('status',1)->select('id','name')->get();
        $units          = Unit::select('id','title')->get();
        $priorities = $this->priority();

        return view('lead.lead_save', compact('customers','priorities','title','projects','units'));
    }

    public function save(Request $request, $id = null)
    {
        $validator = Validator::make($request->all(), [
            'customer'   => 'required',
            'priority'   => 'required',
            'project'    => 'required',
            'unit'       => 'required',
            'purchase_date' => 'required',
            'remark'     => 'nullable|string|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator)->with('error', $validator->errors()->first());
        }

        if (!empty($id)) {
            $cold_calling = Lead::find($id);
            $cold_calling->update([
                'customer_id'   => $request->customer,
                'purchase_capacity'         => $request->priority,
                'remark'        => $request->remark,
                'employee_id'   => 1, #dummy
                'project_id'    => $request->project,
                'unit_id'       => $request->unit,
                'status'        => 1, #dummy
                'possible_purchase_date' => date('Y-m-d', strtotime($request->purchase_date)),
                'created_by'    => auth()->id(),
                'created_at'    => now(),
            ]);
            return redirect()->route('lead.index')->with('success','Lead update successfully');

        } else {
            $prospecting = new Lead();
            $prospecting->purchase_capacity      = $request->priority;
            $prospecting->remark        = $request->remark;
            $prospecting->customer_id   = $request->customer;
            $prospecting->employee_id   = 1;    #dummy
            $prospecting->project_id    = $request->project;    
            $prospecting->unit_id       = $request->unit;    
            $prospecting->updated_by    = auth()->id();
            $prospecting->possible_purchase_date     = date('Y-m-d', strtotime($request->purchase_date));
            $prospecting->updated_at    = now();
            $prospecting->save();
            return redirect()->route('lead.index')->with('success','Lead create successfully');
        }
    }

    public function edit($id)
    {
        $title = 'Lead Edit';
        $user_id   = Auth::user()->id; 
        $my_all_employee = my_all_employee($user_id);
        $customers = Customer::whereIn('ref_id', $my_all_employee)->get();
        $projects = Project::where('status',1)->select('id','name')->get();
        $units          = Unit::select('id','title')->get();
        $priorities = $this->priority();
        $lead = Lead::find($id);

        return view('lead.lead_save', compact('customers','priorities','title','projects','units','lead'));
    }

    public function destroy(string $id)
    {
        //
    }
}
