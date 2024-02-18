<?php

namespace App\Http\Controllers;

use App\Enums\Priority;
use App\Models\ColdCalling;
use App\Models\Customer;
use App\Models\Profession;
use App\Models\Project;
use App\Models\Prospecting;
use App\Models\Unit;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ColdCallingController extends Controller
{
    public function priority()
    {
        return Priority::values();
    }

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
        $cold_callings = ColdCalling::whereHas('customer', function($q) use($user_employee){ 
            $q->whereIn('ref_id', $user_employee);
        }); 

         if(isset($request->profession) && !empty($request->profession)){
            $profession = (int)$request->profession;
            $cold_callings = $cold_callings->whereHas('customer', function($q) use($profession){ 
                $q->where('profession_id', $profession);
            });
         } 
         $cold_callings = $cold_callings->get();  
         $filter =  $request->all();
        return view('cold_calling.cold_calling_list', compact('cold_callings','employee_data','professions','employees','filter'));
    }

    public function create()
    {        
        $title = 'Cold Calling Entry';
        $user_id            = Auth::user()->id; 
        $my_all_employee    = my_all_employee($user_id);
        $customers          = Customer::whereIn('ref_id', $my_all_employee)->get();
        // $customer = Prospecting::where('status',0)->where('approve_by','!=',null)->whereHas('customer',function($q) use($my_all_employee){
        //     $q->whereIn('ref_id',$my_all_employee);
        // }); 

        $priorities         = $this->priority();
        $projects           = Project::where('status',1)->select('id','name')->get();
        $units              = Unit::select('id','title')->get();
        return view('cold_calling.cold_calling_save',compact('title','customers','priorities','projects','units'));
    }

    public function save(Request $request, $id = null)
    {
        $validator = Validator::make($request->all(), [
            'customer'   => 'required',
            'priority'   => 'required',
            'project'    => 'required',
            'unit'       => 'required',
            'remark'     => 'nullable|string|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator)->with('error', $validator->errors()->first());
        }

        if (!empty($id)) {
            $cold_calling = ColdCalling::find($id);
            $cold_calling->update([
                'customer_id'   => $request->customer,
                'media'         => 1, # dummy
                'priority'      => $request->priority,
                'remark'        => $request->remark,
                'customer_id'   => $request->customer,
                'employee_id'   => 1, #dummy
                'project_id'    => $request->project,
                'unit_id'       => $request->unit,
                'status'        => 1, #dummy
                'created_by'    => auth()->id(),
                'created_at'    => now(),
            ]);
            return redirect()->route('cold-calling.index')->with('success','Cold Calling update successfully');

        } else {
            $prospecting = new ColdCalling();
            $prospecting->media         = 1;    #dummy
            $prospecting->priority      = $request->priority;
            $prospecting->remark        = $request->remark;
            $prospecting->customer_id   = $request->customer;
            $prospecting->employee_id   = 1;    #dummy
            $prospecting->project_id    = $request->project;    
            $prospecting->unit_id       = $request->unit;    
            $prospecting->updated_by    = auth()->id();
            $prospecting->updated_at    = now();
            $prospecting->save();
            return redirect()->route('cold-calling.index')->with('success','Cold Calling create successfully');
        }
    }

    public function edit(string $id)
    {
        $title = 'Cold Calling Edit';
        $user_id   = Auth::user()->id; 
        $my_all_employee = my_all_employee($user_id);
        $customers = Customer::whereIn('ref_id', $my_all_employee)->get();
        $priorities = $this->priority();
        $projects = Project::where('status',1)->select('id','name')->get();
        $units          = Unit::select('id','title')->get();
        return view('cold_calling.cold_calling_save',compact('title','customers','priorities','projects','units'));
    }

    public function colCallingDelete($id){
        try{ 
            $data  = ColdCalling::find($id);
            $data->delete();
            return response()->json(['success' => 'Cold Calling Deleted'],200);
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()],500);
        }
    }
}
