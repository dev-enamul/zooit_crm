<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(){
        return view('employee.employee_list');
    }

    public function create(){
        return view('employee.employee_create');
    }

    // public function show(){
    //     return view('employee.employee_tree');
    // }

    public function tree(){
        return view('employee.employee_tree');
    }
}
