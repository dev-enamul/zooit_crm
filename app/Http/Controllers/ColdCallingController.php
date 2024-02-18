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
use Illuminate\Support\Facades\DB;
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
         $cold_callings = $cold_callings->with('project','employee')->get();  
         $filter =  $request->all();
        return view('cold_calling.cold_calling_list', compact('cold_callings','employee_data','professions','employees','filter'));
    }

    public function create(Request $request)
    {        
        $title = 'Cold Calling Entry';
        $user_id            = Auth::user()->id; 
        $my_all_employee    = my_all_employee($user_id);
        $cstmrs             = Prospecting::where('status',0)->where('approve_by','!=',null)->whereHas('customer',function($q) use($my_all_employee){
                                $q->whereIn('ref_id',$my_all_employee);
                              })->get();
        $employees          = User::whereIn('id', $my_all_employee)->get();
        $priorities         = $this->priority();
        $projects           = Project::where('status',1)->select('id','name')->get();
        $units              = Unit::select('id','title')->get();

        $selected_data = 
        [
            'employee' => Auth::user()->id,
            'priority' => Priority::Regular,
        ];
        if ($request->has('customer')) {
            $selected_data['customer'] = $request->customer;
        }
        return view('cold_calling.cold_calling_save',compact('title','cstmrs','priorities','projects','units','selected_data','employees'));
    }

    public function save(Request $request, $id = null)
    {
        $validator = Validator::make($request->all(), [
            'customer'   => 'required|unique:cold_callings,customer_id,'.$id,
            'employee'   => 'required',
            'priority'   => 'required',
            'project'    => 'required',
            'unit'       => 'required',
            'remark'     => 'nullable|string|max:255'
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
                'employee_id'   => $request->employee,
                'project_id'    => $request->project,
                'unit_id'       => $request->unit,
                'updated_by'    => auth()->id(),
                'updated_at'    => now(),
            ]);
            return redirect()->route('cold-calling.index')->with('success','Cold Calling update successfully');

        } else {
            $cold_call = new ColdCalling();
            $cold_call->media         = 1;    #dummy
            $cold_call->priority      = $request->priority;
            $cold_call->remark        = $request->remark;
            $cold_call->customer_id   = $request->customer;
            $cold_call->employee_id   = $request->employee;
            $cold_call->project_id    = $request->project;    
            $cold_call->unit_id       = $request->unit;
            $cold_call->status        = 0;    
            $cold_call->created_by    = auth()->id();
            $cold_call->created_at    = now();
            $cold_call->save();

            if($cold_call) {
                $prospecting = Prospecting::where('customer_id',$request->customer)->first();
                $prospecting->status = 1;
                $prospecting->save();
            }
            return redirect()->route('cold-calling.index')->with('success','Cold Calling create successfully');
        }
    }

    public function edit(string $id)
    {
        $title = 'Cold Calling Edit';
        $user_id   = Auth::user()->id; 
        $my_all_employee = my_all_employee($user_id);
        $cstmrs     = Prospecting::where('status',0)->where('approve_by','!=',null)->whereHas('customer',function($q) use($my_all_employee){
                                    $q->whereIn('ref_id',$my_all_employee);
                                })->get();
        $priorities = $this->priority();
        $projects = Project::where('status',1)->select('id','name')->get();
        $units          = Unit::select('id','title')->get();
        $cold_calling = ColdCalling::find($id);
        $employees   = User::whereIn('id', $my_all_employee)->get();
        return view('cold_calling.cold_calling_save',compact('title','cstmrs','priorities','projects','units','cold_calling','employees'));
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

    public function coldCallingApprove(){ 
        $user_id        = Auth::user()->id; 
        $my_employee    = my_employee($user_id);
        // $cold_callings  = ColdCalling::where('approve_by', null)->whereIn('employee_id',$my_employee)->orderBy('id','desc')->get(); 
        $cold_callings  = ColdCalling::where('approve_by', null)->orderBy('id','desc')->get(); 
        return view('cold_calling.cold_calling_approve', compact('cold_callings'));
    }

    public function coldCallingApproveSave(Request $request) {
        if($request->has('cold_calling_id') && $request->cold_calling_id !== '' & $request->cold_calling_id !== null) {
            DB::beginTransaction();
            try {
                foreach ($request->cold_calling_id as $key => $cold_calling_id) {
                    $prospecting = ColdCalling::where('id',$cold_calling_id)->first();
                    $prospecting->approve_by = Auth::user()->id;
                    $prospecting->save();
                }
                DB::commit();
                return redirect()->route('cold-calling.approve')->with('success', 'Status Updated Successfully');
            } catch (Exception $e) {
                DB::rollback();
                return redirect()->back()->withInput()->with('error', $e->getMessage());
            }
            
        } else {
            return redirect()->route('cold-calling.approve')->with('error', 'Something went wrong!');
        }

    }
}
