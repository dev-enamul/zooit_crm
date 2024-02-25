<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\User;
use App\Models\UserPermission;
use Exception;
use Illuminate\Http\Request;

class EmployeePermissionController extends Controller
{
    public function employee_permission($id){
        $id = decrypt($id);  
        $datas = Permission::where('status',1)->get();
        $employee = User::find($id);
        $selected = UserPermission::where('user_id', $id)->pluck('permission_id')->toArray(); 
        return view('employee.employee_permission',compact('datas','employee','selected'));
    }

    public function user_permission_update(Request $request){ 
        $selected = UserPermission::where('user_id', $request->user_id)->delete(); 
        try{
            $permission = $request->permission;
            if(is_array($request->permission)){
                foreach($permission as $item){
                    UserPermission::create([
                        'user_id' => $request->user_id,
                        'permission_id'  => $item,
                    ]);
                }
            }
            return redirect()->back()->with('success','Permission Updated');
        }catch(Exception $e){
            return redirect()->back()->with('error',$e);
        }
    }
}
