<?php

namespace App\Http\Controllers;

use App\Models\Salse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalseApproveController extends Controller
{
    public function salse_approve(){
        $designation = Auth::user()->employee->designation_id;
        if($designation==1){
            $datas = Salse::whereHas('salseApprove', function($q){
                $q->whereNot('user_id', Auth::user()->id);
            })->get();
        }

        dd($datas);
    }
}
