<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\DepositCategory;
use App\Models\Designation;
use App\Models\Project;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;

class SpecialOfferController extends Controller
{
    public function index()
    {
        return view('setting.special_offer.special_offer_list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $designations =  Designation::where('status',1)->get();
        $customers = User::where('status',1)->where('user_type',3)->get();
        $deposit_types = DepositCategory::where('status',1)->get();
        $projects = Project::where('status',1)->get();
        $units = Unit::where('status',1)->get();
        return view('setting.special_offer.special_offer_create',compact([
            'designations',
            'customers',
            'deposit_types',
            'projects',
            'units'
        ]));
    } 

    public function achiver(){
        return view('setting.special_offer.special_offer_achiver');
    }
}
