<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FreelancerProfileController extends Controller
{
    public function freelancer_profile(){
        return view('freelancer.freelancer_profile');
    }

    public function freelancer_hierarchy(){
        return view('freelancer.freelancer_hierarchy');
    } 

    public  function freelancer_book_reading(){
        return view('freelancer.freelancer_book');
    } 

    public function freelancer_field_work(){
        return view('freelancer.freelancer_field_work');
    } 

    public function freelancer_wallet(){
        return view('freelancer.freelancer_wallet');
    } 

    public function freelancer_sales(){
        return view('freelancer.freelancer_sales');
    }
}
