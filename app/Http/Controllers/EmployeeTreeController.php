<?php

namespace App\Http\Controllers;

use App\Models\ReportingUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeTreeController extends Controller
{
    public function tree(Request $request){
        if(isset($request->employee) && !empty($request->employee)){
            $user_id = (int)$request->employee;
        }else{
            $user_id = Auth::user()->id;
        } 

        $topUser = ReportingUser::where('user_id',  $user_id)
        ->select(['id', 'user_id'])
        ->first(); 
        $employee =  User::find($user_id);
        $organogram = getOrganogram($topUser); 
        return view('employee.employee_tree',compact('organogram','employee'));
    } 

    public function hierarchy(Request $request){
        if(isset($request->employee) && !empty($request->employee)){
            $user_id = decrypt($request->employee);
        }else{
            $user_id = Auth::user()->id;
        } 

        $topUser = ReportingUser::where('user_id',  $user_id)
        ->select(['id', 'user_id'])
        ->first();
        $employee =  User::find($user_id);
        $organogram = getOrganogram($topUser);  

        // return view('employee.employee_hierarchy',compact('organogram','employee'));
        return view('employee.only_employee',compact('organogram','employee'));
    } 

    public function hierarchy2(Request $request){
        if(isset($request->employee) && !empty($request->employee)){
            $user_id = decrypt($request->employee);
        }else{
            $user_id = Auth::user()->id;
        } 
     
        $my_emplyees = my_employee($user_id); 
        $employee =  User::find($user_id); 
        $reporting=user_reporting($user_id); 
        return view('employee.employee_hierarchy',compact('employee','my_emplyees','reporting')); 
    }
}
