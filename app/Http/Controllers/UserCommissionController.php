<?php

namespace App\Http\Controllers;

use App\Models\UserCommission;
use Illuminate\Http\Request;

class UserCommissionController extends Controller
{
    public function index()
    {
        return view('setting.user_commission');
    }

    public function save(Request $request){
        $request->validate([
            'user_id' => 'required',
            'total_commission' => 'required',
            'paid_commission' => 'required',
        ]);

        try{
            $ex_commission = UserCommission::where('user_id', $request->user_id)->first();
            if($ex_commission){
                $ex_commission->total_commission = $request->total_commission;
                $ex_commission->paid_commission = $request->paid_commission;
                // $ex_commission->pending_commission = $request->total_commission - $request->paid_commission;
                $ex_commission->save();
            }else{
                UserCommission::create([
                    'user_id' => $request->user_id,
                    'total_commission' => $request->total_commission,
                    'paid_commission' => $request->paid_commission,
                    // 'pending_commission' => $request->total_commission - $request->paid_commission
                ]);
            }
            return redirect()->back()->with('success', 'User Commission Updated');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Something went wrong');
        }
        
        
    }
}
