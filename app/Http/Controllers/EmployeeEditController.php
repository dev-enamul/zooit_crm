<?php

namespace App\Http\Controllers;

use App\Models\ReportingUser;
use App\Models\User;
use App\Traits\ImageUploadTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeEditController extends Controller
{
    use ImageUploadTrait;
    public function reporting_edit($id){
        try{
            $employees = User::where('user_type','1')->where('status',1)->select('id','name','user_id')->get();
            $user = User::find($id); 
            return view('employee.edit.update_reporting',compact('employees','user'));
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function reporting_update(Request $request, $id){
      
        $validator = Validator::make($request->all(), [
            'reporting_id' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif|max:10000'
        ]);

        if ($validator->fails()) { 
            if ($validator->fails()) {
                return redirect()->back()->withInput()->withErrors($validator)->with('error',  $validator->errors()->first());
            }
        }
        
        DB::beginTransaction();
        try{   
            $user_reporting = ReportingUser::where('user_id',$id)->whereNull('deleted_at')->first();
            if($user_reporting != null){
                $user_reporting->status = 0;
                $user_reporting->deleted_by = auth()->user()->id; 
                $user_reporting->deleted_at = Carbon::now()->subDay(1);
                $user_reporting->save();
            }
            
            $reporting_user = new ReportingUser();
            $reporting_user->user_id = $id;
            $reporting_user->reporting_id = $request->reporting_id;

            if ($request->hasFile('image')) {
                $image = $this->uploadImage($request, 'image', 'user_update_document', 'public');
                $reporting_user->change_reason_document = $image;
                $reporting_user->save();
            }

            DB::commit();
            return redirect()->route('employee.index')->with('success', 'Reporting updated successfully');
        }catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    } 

    public function update_area($id){
        return view('employee.edit.update_area');
    }

    public function deactive_employee($id){
        return view('employee.edit.deactive_employee'); 
    }

    public function update_designation($id){
        return view('employee.edit.update_designation');
    }
}
