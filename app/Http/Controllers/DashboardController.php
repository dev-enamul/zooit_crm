<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $user= Auth::id();
        return view('index',compact('user'));
    }

    public function migrate_fresh(){ 
       
        Artisan::call('migrate:fresh');
        Artisan::call('db:seed'); 
        return redirect()->route('index');
    }
}
