<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FieldTargetController extends Controller
{
     public function assign_target(){
        $my_employee = my_employee(auth()->user()->id);
        $employeies = User::whereIn('id',$my_employee)->where('status',1)->get(); 
         return view('target.field_target.assign_target',compact('employeies'));
     }


    public function target_achive(){
        return view('target.field_target.target_achive');
    }

    public function today_target(){
        return view('target.today_target');
    } 

    public function marketing_field_report(){
        return view('target.marketing_field_report');
    } 

    public function salse_field_report(){
        return view('target.salse_field_report');
    }
}
