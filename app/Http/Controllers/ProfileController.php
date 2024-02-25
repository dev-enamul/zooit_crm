<?php

namespace App\Http\Controllers;

use App\Models\DepositCommission;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(){
        $commission = DepositCommission::where('user_id',auth()->user()->id)->get();
        return view('profile.profile');
    }
}
