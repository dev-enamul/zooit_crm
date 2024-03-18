<?php

namespace App\Http\Controllers;

use App\Models\Salse;
use App\Models\SalseApprove;
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

    public function salse_approve_save($id){ 
        $id = decrypt($id); 
        $salse = Salse::find($id); 
        SalseApprove::create([
            'salse_id' => $salse->id,
            'customer_id' => $salse->customer_id,
            'user_id' => Auth::user()->id,
        ]);
        $final_approve_permission = Auth()->user()->hasPermission('salse-approve');
        if($final_approve_permission){
            $salse->update([
                'approve_by' => Auth::user()->id,
            ]);
        }
        return redirect()->route('salse.index')->with('success','Salse Approved Successfully');

    }
}
