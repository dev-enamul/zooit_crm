<?php

namespace App\Http\Controllers;

use App\Enums\Priority;
use App\Models\ApproveSetting;
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
     
        if(isset($request->employee) && !empty($request->employee)){
            $user_id = (int)$request->employee;
        }else{
            $user_id = Auth::user()->id;
        }  
        $user_employee = my_all_employee($user_id);

        $cold_callings = ColdCalling::where(function ($q){
            $q->where('approve_by','!=',null)
                ->orWhere('employee_id', Auth::user()->id)
                ->orWhere('created_by', Auth::user()->id);
        }) 
        ->whereHas('customer', function($q) use($user_employee){ 
            $q->whereIn('ref_id', $user_employee);
        }); 

         if(isset($request->profession) && !empty($request->profession)){
            $profession = (int)$request->profession;
            $cold_callings = $cold_callings->whereHas('customer', function($q) use($profession){ 
                $q->where('profession_id', $profession);
            });
         } 
          
 
        if(isset($request->status) && !empty($request->status)){
            $status = (int)$request->status;
            $cold_callings = $cold_callings->where('status', $status);
        }else{
            $cold_callings = $cold_callings->where('status', 0);
        } 
        $cold_callings = $cold_callings->get();
 
        $filter =  $request->all();
        return view('cold_calling.cold_calling_list', compact('cold_callings','professions','filter'));
    }

    public function create(Request $request)
    {        
        $title = 'Cold Calling Entry';
        $user_id            = Auth::user()->id;  
        $priorities         = $this->priority();
        $projects           = Project::where('status',1)->select('id','name')->get();
        $units              = Unit::select('id','title')->get(); 
        $selected_data = 
        [
            'employee' => Auth::user()->id,
            'priority' => Priority::Regular,
        ];
        if ($request->has('customer')) {
            $selected_data['customer'] = Customer::find($request->customer);
        }
        return view('cold_calling.cold_calling_save',compact('title','priorities','projects','units','selected_data'));
    }

    public function save(Request $request, $id = null)
    {
        $validator = Validator::make($request->all(), [
            'customer'   => 'required|unique:cold_callings,customer_id,'.$id,
            'employee'   => 'required',
            'priority'   => 'required', 
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
            $approve_setting = ApproveSetting::where('name','cold_calling')->first(); 
            $is_admin = Auth::user()->hasPermission('admin'); 
            if($approve_setting?->status == 0 || $is_admin){ 
                $cold_call->approve_by = auth()->user()->id;
            }  

            $cold_call->created_by    = auth()->id();
            $cold_call->created_at    = now();
            $cold_call->save();

            if($cold_call) {
                $prospecting = Prospecting::where('customer_id',$request->customer)->first();
             
                if(isset($prospecting) && $prospecting != null){
                    $prospecting->status = 1;
                    $prospecting->save();
                } 
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
        $cold_callings  = ColdCalling::where('approve_by', null)->whereIn('employee_id',$my_employee)->orderBy('id','desc')->get(); 
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

    public function select2_customer(Request $request){
        $request->validate([
            'term' => ['nullable', 'string'],
        ]);

        $user_id   = Auth::user()->id;
        $my_all_employee = my_all_employee($user_id);   
        $is_admin = Auth::user()->hasPermission('admin'); 
        $results = [
            ['id' => '', 'text' => 'Select Product']
        ]; 

        if($is_admin){ 
            $users = Customer::query()
                ->where(function ($query) use ($request) {
                    $term = $request->term;
                    $query->where('customer_id', 'like', "%{$term}%")
                        ->orWhere('name', 'like', "%{$term}%");
                })
                ->whereDoesntHave('salse')
                ->select('id', 'name', 'customer_id')
                ->limit(10)
                ->get();  
                
            foreach ($users as $user) {
                $results[] = [
                    'id' => $user->id,
                    'text' => "{$user->name} [{$user->customer_id}]"
                ]; 
            } 
        }else{
            $users = Prospecting::where('status',0)->where('approve_by','!=',null)
            ->whereHas('customer',function($q) use($my_all_employee,$request){
                $q->whereIn('ref_id',$my_all_employee)
                ->where(function ($query) use ($request) {
                    $term = $request->term;
                    $query->where('customer_id', 'like', "%{$term}%")
                        ->orWhere('name', 'like', "%{$term}%");
                });
              })->get(); 
              foreach ($users as $user) {
                $results[] = [
                    'id' => $user->customer->id,
                    'text' => "{$user->customer->name} [{$user->customer->customer_id}]"
                ]; 
            }
        }  
         
        return response()->json([
            'results' => $results
        ]);
    }
}
