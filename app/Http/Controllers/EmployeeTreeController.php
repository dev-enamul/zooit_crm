<?php

namespace App\Http\Controllers;

use App\Models\ReportingUser;
use Illuminate\Http\Request;

class EmployeeTreeController extends Controller
{
    public function tree(){ 
        $topUser = ReportingUser::where('user_id', 1)
        ->select(['id', 'user_id'])
        ->first(); 
        $organogram = getOrganogram($topUser); 
        return view('employee.employee_tree',compact('organogram'));
    } 
}
