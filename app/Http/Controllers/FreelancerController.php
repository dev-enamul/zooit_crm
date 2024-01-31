<?php

namespace App\Http\Controllers;

use App\Models\Freelancer;
use Illuminate\Http\Request;

class FreelancerController extends Controller
{
    public function index(){ 
        $datas=  Freelancer::where('status',1)->get();
        return view('freelancer.freelancer_list',compact('datas'));
    }

    public function create(){
        return view('freelancer.freelancer_create');
    } 

    
}
