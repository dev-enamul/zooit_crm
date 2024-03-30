<?php

namespace App\Http\Controllers;

use App\Models\Salse;
use App\Models\SalseApprove;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalseApproveController extends Controller
{
    public function salse_approve(){ 
        $final_approve_permission = Auth()->user()->hasPermission('salse-approve'); 
        $designation = Auth::user()->employee->designation_id;
        $datas = Salse::whereDoesntHave('salseApprove')
        ->orWhereHas('salseApprove', function ($q) {
            $q->where('user_id', '!=', Auth::user()->id);
        });
        $datas =  $datas->whereHas('customer', function ($q) { 
            $my_all_employee = my_all_employee(auth()->user()->id);
            $q->whereIn('ref_id', $my_all_employee);
        })->get();  
        return view('salse.salse_approve',compact('datas'));
    }

    public function salse_approve_save($id){
        $id = decrypt($id);
        $salse = Salse::find($id);
        $final_approve_permission = Auth()->user()->hasPermission('salse-approve'); 
        SalseApprove::create([
            'salse_id' => $salse->id,
            'customer_id' => $salse->customer_id,
            'user_id' => Auth::user()->id,
        ]); 
        if($final_approve_permission){
            $salse->update([
                'approve_by' => Auth::user()->id,
                'status' => 1,
            ]);
        }
        return redirect()->route('salse.index')->with('success','Salse Approved Successfully'); 
    }
}
