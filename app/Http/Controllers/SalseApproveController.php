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
            $datas = Salse::whereDoesntHave('salseApprove')
            ->orWhereHas('salseApprove', function ($q) {
                $q->where('user_id', '!=', Auth::user()->id);
            })
            ->get();
        } 
        return view('salse.salse_approve',compact('datas'));
    }
}
