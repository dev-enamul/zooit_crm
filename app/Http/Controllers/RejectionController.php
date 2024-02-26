<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\NegotiationAnalysis;
use App\Models\Rejection;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RejectionController extends Controller
{
     
    public function index(Request $request)
    {

        $my_all_employee = my_all_employee(auth()->user()->id);
        $employee_data = Customer::whereIn('ref_id', $my_all_employee)->get(); 
        $employees = User::whereIn('id', $my_all_employee)->get();

        if(isset($request->employee) && !empty($request->employee)){
            $user_id = (int)$request->employee;
        }else{
            $user_id = Auth::user()->id;
        } 
      
        $user_employee = my_all_employee($user_id);
        $rejections = Rejection::whereHas('customer', function($q) use($user_employee){ 
            $q->whereIn('ref_id', $user_employee);
        }); 

        $rejections = $rejections->orderBy('id','desc')->get();  
        $filter =  $request->all();
        return view('rejection.rejection_list', compact('rejections','employee_data','employees','filter'));
    }

   
    public function create(Request $request)
    {
        $title = 'Rejection Entry';
        $user_id            = Auth::user()->id; 
        $my_all_employee    = my_all_employee($user_id);
        $customers          = NegotiationAnalysis::where('status',0)->where('approve_by','!=',null)->whereHas('customer',function($q) use($my_all_employee){
                                    $q->whereIn('ref_id',$my_all_employee);
                                })->get();
        $employees          = User::whereIn('id', $my_all_employee)->get();

        $selected_data = 
        [
            'employee' => Auth::user()->id,
        ];

        if ($request->has('customer')) {
            $selected_data['customer'] = $request->customer;
        }

        return view('rejection.rejection_save',compact('customers','employees','selected_data'));
    }

    public function save(Request $request, $id = null)
    {
        $validator = Validator::make($request->all(), [
            'customer'          => 'required',
            'employee'          => 'required',
            'remark'            => 'nullable',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator)->with('error', $validator->errors()->first());
        }

        if (!empty($id)) {
            $rejection = Rejection::findOrFail($id);
            $rejection->customer_id = $request->customer;
            $rejection->employee_id = $request->employee;

            $rejection->remark = $request->remark;
            $rejection->updated_by = $request->updated_by;
            $rejection->updated_at = $request->updated_at;
            $rejection->save();
            return redirect()->route('rejection.index')->with('success','Rejection update successfully');
        } else {
            $rejection = new Rejection();
            $rejection->customer_id = $request->customer;
            $rejection->employee_id = $request->employee;

            $rejection->remark = $request->remark;
            $rejection->created_by = auth()->id();
            $rejection->created_at = now();
            $rejection->status = 0;
            $rejection->save();

            if($rejection) {
                $visit = NegotiationAnalysis::where('customer_id',$request->customer)->first();
                $visit->status = 1;
                $visit->save();
            }
            
            return redirect()->route('rejection .index')->with('success','Rejection create successfully');
        }
    }

    public function edit(string $id, Request $request)
    {
        $title = 'Rejection Edit';
        $user_id            = Auth::user()->id; 
        $my_all_employee    = my_all_employee($user_id);
        $customers          = NegotiationAnalysis::where('status',0)->where('approve_by','!=',null)->whereHas('customer',function($q) use($my_all_employee){
                                    $q->whereIn('ref_id',$my_all_employee);
                                })->get();
        $employees          = User::whereIn('id', $my_all_employee)->get();

        $selected_data = 
        [
            'employee' => Auth::user()->id,
        ];

        if ($request->has('customer')) {
            $selected_data['customer'] = $request->customer;
        }

        $rejection = Rejection::find($id);

        return view('rejection.rejection_save',compact('customers','employees','selected_data','rejection'));
    }


    public function rejectionDelete($id){
        try{ 
            $data  = Rejection::find($id);
            $data->delete();
            return response()->json(['success' => 'Rejection Deleted'],200);
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()],500);
        }
    }

    public function rejectionApprove(){ 
        $user_id        = Auth::user()->id; 
        $my_employee    = my_employee($user_id);
        $rejections     = Rejection::where('approve_by', null)->whereIn('employee_id',$my_employee)->orderBy('id','desc')->get(); 
        return view('rejection.rejection_approve', compact('rejections'));
    }

    public function rejectionApproveSave(Request $request) {
        if($request->has('rejection_id') && $request->rejection_id !== '' & $request->rejection_id !== null) {
            DB::beginTransaction();
            try {
                foreach ($request->rejection_id as $key => $rejection_id) {
                    $lead = Rejection::where('id',$rejection_id)->first();
                    $lead->approve_by = Auth::user()->id;
                    $lead->save();
                }
                DB::commit();
                return redirect()->route('rejection.approve')->with('success', 'Status Updated Successfully');
            } catch (Exception $e) {
                DB::rollback();
                return redirect()->back()->withInput()->with('error', $e->getMessage());
            }
            
        } else {
            return redirect()->route('rejection.approve')->with('error', 'Something went wrong!');
        }
    }
}
