<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FreelancerController extends Controller
{
    public function index(){
        return view('freelancer.freelancer_list');
    }

    public function create(){
        return view('freelancer.freelancer_create');
    } 

    
}
