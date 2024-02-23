<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Designation;
use App\Models\DesignationPermission;
use App\Models\Employee;
use App\Models\Freelancer;
use App\Models\ReportingUser;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\UserPermission;
use App\Models\Zone;
use App\Traits\ImageUploadTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FreelancerEditController extends Controller
{
    use ImageUploadTrait; 

    public function deactive_user($id){  
        DB::beginTransaction();
        try{
            $user = User::find($id); 
            if(!$user){
                return response()->json(['error' => 'User Not Found']);
            }  
            if($user->id == auth()->user()->id){
                return response()->json(['error' => 'You can not deactivate yourself']);
            } 
            if($user->id==1){
                return response()->json(['error' => 'You can not deactivate super admin']);
            }  

            $my_employee = my_employee($user->id); 
            if(count($my_employee) > 0){
                return response()->json(['error' => $user->name.' has employees. Please transfer them to another employee']);
            }  
            
            #user
            $user->status = 0;
            $user->save();  

            #reporting user
            $user->reportingUser->status = 0;
            $user->reportingUser->deleted_by = auth()->user()->id;
            $user->reportingUser->deleted_at = Carbon::now(); 
            $user->reportingUser->save();

            #freelancer
            $user->freelancer->status = 0;
            $user->freelancer->save(); 

            
 
            
            DB::commit();
            return response()->json(['success' => 'Employee Deactivated successfully']);
        }catch(Exception $e){ 
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function designation_edit($id){
        $user = User::find($id);
        $designations = Designation::where('status',1)->where('designation_type',2)->get();
        return view('freelancer.edit.update_designation',compact('user','designations'));
    }

    public function designation_update(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'designation_id' => 'required',
            'image'         => 'mimes:jpeg,jpg,png,gif|max:2048'
        ]);

        if ($validator->fails()) { 
            if ($validator->fails()) {
                return redirect()->back()->withInput()->withErrors($validator)->with('error',  $validator->errors()->first());
            }
        } 

        DB::beginTransaction();
       try{
            $freelancer = Freelancer::where('user_id',$id)->first(); 
            if($freelancer ==null){
                return redirect()->back()->with('error', 'Freelancer not found');
            } 

            $freelancer->designation_id = $request->designation_id;
            if ($request->hasFile('image')) {
                $image = $this->uploadImage($request, 'image', 'employees', 'public'); 
                $freelancer->change_reason_document = $image; 
            }
            $freelancer->save();

            UserPermission::where('user_id', $id)->delete();
            $permissions = DesignationPermission::where('designation_id', $request->designation)->pluck('permission_id')->toArray();
            foreach($permissions as $permission){
                UserPermission::create([
                    'user_id'       => $freelancer->id,
                    'permission_id' => $permission,
                ]);
            }   
            DB::commit();
            return redirect()->route('freelancer.index')->with('success', 'Designation updated successfully');
       }catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
       }

    }
}
