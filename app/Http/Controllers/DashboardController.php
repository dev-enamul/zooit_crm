<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Designation;
use App\Models\District;
use App\Models\Division;
use App\Models\Union;
use App\Models\Upazila;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $user= Auth::id();
        return view('index',compact('user'));
    }

    public function id(){ 
        $designations = Designation::all();
        $divisions = Division::all();
        $districts = District::all();
        $upazilas = Upazila::all();
        $unions = Union::all();
        $vilages = Village::all();
        $banks = Bank::where('status',1)->get();
        $mobile_banks = Bank::where('status',2)->get(); 
        return view('ids',compact([
            'designations',
            'divisions',
            'districts',
            'upazilas',
            'unions',
            'vilages',
            'banks',
            'mobile_banks' 
        ]));
    }

    public function migrate_fresh(){  
        Artisan::call('migrate:fresh');
        Artisan::call('db:seed'); 
        return redirect()->route('index');
    }
}
