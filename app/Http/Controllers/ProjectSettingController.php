<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectSettingController extends Controller
{
    public function unit_type(){
        return view('setting.project.unit_type');
    }

    public function unit_category(){
        return view('setting.project.unit_category');
    } 
}
