<?php

namespace App\Http\Controllers;

use App\Events\UserCreatedEvent;
use App\Models\Area;
use App\Models\Designation;
use App\Models\DesignationPermission;
use App\Models\Employee;
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

class EmployeeEditController extends Controller
{
    use ImageUploadTrait;
    public function reporting_edit($id){
        try{ 
            $id = decrypt($id); 
            
     
            $user = User::findOrFail($id, ['id', 'name', 'user_id']);  
            return view('employee.edit.update_reporting', compact('user'));
        } catch(Exception $e) { 
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function reporting_update(Request $request, $id){ 
       
        $validator = Validator::make($request->all(), [
            'reporting_id' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif|max:2048'
        ]);

        if ($validator->fails()) { 
            if ($validator->fails()) {
                return redirect()->back()->withInput()->withErrors($validator)->with('error',  $validator->errors()->first());
            }
        }
        
        DB::beginTransaction();
        try{
            $ex_reporting_user = ReportingUser::where('user_id', $id)->where('status',1)->latest()->first();
            if(isset($ex_reporting_user) && $ex_reporting_user != null && $request->reporting_id == $ex_reporting_user->id){
                return redirect()->back()->with('error', 'You can not select own reporting user');
            } 

            if($ex_reporting_user != null){
                $ex_reporting_user->status = 0;
                $ex_reporting_user->deleted_by = auth()->user()->id; 
                $ex_reporting_user->deleted_at = Carbon::now();
                $ex_reporting_user->save();
            }
            
            $reporting_user = new ReportingUser();
            $reporting_user->user_id = $id;
            $reporting_user->reporting_user_id = $request->reporting_id;
 
            if ($request->hasFile('image')) { 
                $image = $this->uploadImage($request, 'image', 'reporting_users', 'public'); 
                $reporting_user->change_reason_document = $image; 
            }  
            $reporting_user->save(); 
 
            if(isset($ex_reporting_user) && $ex_reporting_user!=null){
                $my_employee = ReportingUser::where('reporting_user_id',$ex_reporting_user->id)->where('status',1)->get();
                foreach($my_employee as $employee){
                    $employee->reporting_user_id = $reporting_user->id;
                    $employee->save();
                } 
            } 
 
            DB::commit();

            if($ex_reporting_user != null && $ex_reporting_user->reporting_user_id != null){
                $ex_senior_id = ReportingUser::find($ex_reporting_user->reporting_user_id);
                if($ex_senior_id != null && $ex_senior_id->user_id != null){ 
                    UserCreatedEvent::dispatch((int)$ex_senior_id->user_id);
                } 
            } 
            UserCreatedEvent::dispatch((int)$id);
          
            
            if($reporting_user->user->user_type == 1){
                return redirect()->route('employee.index')->with('success', 'Reporting updated successfully'); 
            }else{
                return redirect()->route('freelancer.index')->with('success', 'Reporting updated successfully');
            } 
        }catch(Exception $e){
            dd($e);
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    } 

    public function area_edit($id){ 
        $id = decrypt($id);
        $user = User::find($id);
        $zones = Zone::where('status',1)->get();
        $areas = Area::where('status',1)->get();
        return view('employee.edit.update_area',compact('user','zones','areas'));
    }

    public function area_update(Request $request, $id){
        $validator = Validator::make($request->all(),[ 
            'image'   => 'mimes:jpeg,jpg,png,gif|max:2048'
        ]);

        if ($validator->fails()) { 
            if ($validator->fails()) {
                return redirect()->back()->withInput()->withErrors($validator)->with('error',  $validator->errors()->first());
            }
        }
        DB::beginTransaction();
        try{   
            
            $user_address = UserAddress::where('user_id',$id)->first();
            if($user_address!=null){
                $user_address->zone_id = $request->zone_id;
                $user_address->area_id = $request->area_id;
                if ($request->hasFile('image')) {
                    $image = $this->uploadImage($request, 'image', 'user_addresses', 'public'); 
                    $user_address->change_reason_document = $image; 
                } 
            }else{
                $user_address = new UserAddress();
                $user_address->user_id = $id;
                $user_address->zone_id = $request->zone_id;
                $user_address->area_id = $request->area_id;
                if ($request->hasFile('image')) {
                    $image = $this->uploadImage($request, 'image', 'user_addresses', 'public'); 
                    $user_address->change_reason_document = $image; 
                }
            } 
            $user_address->save(); 
            DB::commit();

            if($user_address->user->user_type == 1){
                return redirect()->route('employee.index')->with('success', 'Area updated successfully');
            }else{
                return redirect()->route('freelancer.index')->with('success', 'Area updated successfully');
            }
        }catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function deactive_user($id){ 
        $id = decrypt($id);
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
            $user->status = 0;
            $user->save();  

            $user->reportingUser()->status = 0;
            $user->reportingUser()->deleted_by = auth()->user()->id;
            $user->reportingUser()->deleted_at = Carbon::now(); 
            $user->reportingUser()->save();

            $user->employee->status = 0;
            $user->employee->save();
            
            DB::commit();
            return response()->json(['success' => 'Employee Deactivated successfully']);
        }catch(Exception $e){ 
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function designation_edit($id){ 
        $id = decrypt($id);
        $user = User::find($id);
        $designations = Designation::where('status',1)->where('designation_type',1)->get();
        return view('employee.edit.update_designation',compact('user','designations'));
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
            $employee = Employee::where('user_id',$id)->first();
          
            $employee->designation_id = $request->designation_id;
            $employee->designations = json_encode($request->designations);
            if ($request->hasFile('image')) {
                $image = $this->uploadImage($request, 'image', 'employees', 'public'); 
                $employee->change_reason_document = $image; 
            }
            $employee->save();

            // UserPermission::where('user_id', $id)->delete();
            // $permissions = DesignationPermission::where('designation_id', $request->designation)->pluck('permission_id')->toArray();
            // foreach($permissions as $permission){
            //     UserPermission::create([
            //         'user_id'       => $employee->id,
            //         'permission_id' => $permission,
            //     ]);
            // }
            
            DB::commit();
            return redirect()->route('employee.index')->with('success', 'Designation updated successfully');
       }catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
       }

    }

    public function select2_reporting_user(Request $request){
        $request->validate([
            'term' => ['nullable', 'string'],
        ]);
        $users = User::query()
            ->where('user_id', 'like', "%{$request->term}%")
            ->limit(20)
            ->get();
    
        $results = [
            ['id' => '', 'text' => 'Select Product']
        ];
    
        foreach ($users as $user) {
            if(isset($user->reportingUser()->id)){
                $results[] = [
                    'id' => $user->reportingUser()->id,
                    'text' => "{$user->name} ($user->user_id)"
                ];
            } 
            
        }
        return response()->json([
            'results' => $results
        ]);
    }
}
