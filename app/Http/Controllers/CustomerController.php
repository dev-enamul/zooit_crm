<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(){
        return view('customer.customer_list');
    }

    public function create(){
        return view('customer.customer_create');
    }
}
