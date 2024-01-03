<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DepositTargetController extends Controller
{
    public function target(){
        return view('target.deposit_target');
    }

    public function target_asign(){
        return view('target.deposit_target_asign');
    }

    public function target_asign_list(){
        return view('target.deposit_target_asign_list');
    }
}
