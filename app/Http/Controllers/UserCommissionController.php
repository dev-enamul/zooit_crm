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
            'total_regular_commission' => 'required',
            'total_special_commission' => 'required',
            'paid_commission' => 'required', 
            'updated_at' => 'required',
        ]);

        try{
            $ex_commission = UserCommission::where('user_id', $request->user_id)->first();
            if($ex_commission){
                $ex_commission->total_regular_commission = $request->total_regular_commission;
                $ex_commission->total_special_commission = $request->total_special_commission;
                $ex_commission->total_commission = $request->total_regular_commission + $request->total_special_commission;
                $ex_commission->paid_commission = $request->paid_commission;
                $ex_commission->pending_commission = $ex_commission->total_commission - $request->paid_commission;
                $ex_commission->updated_at = $request->updated_at;
                $ex_commission->save();
            }else{
                UserCommission::create([
                    'user_id' => $request->user_id,
                    'total_regular_commission' => $request->total_regular_commission,
                    'total_special_commission' => $request->total_special_commission,
                    'total_commission' => $request->total_regular_commission + $request->total_special_commission,
                    'paid_commission' => $request->paid_commission,
                    'pending_commission' => $request->total_regular_commission + $request->total_special_commission - $request->paid_commission,
                    'updated_at'  => $request->updated_at,
                ]);
            }
            return redirect()->back()->with('success', 'User Commission Updated');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Something went wrong');
        }
        
        
    } 
 
    public function get(Request $request){
        $user_id = $request->user_id;
        $commission = UserCommission::where('user_id', $user_id)->first();
        return response()->json($commission);
    }
}
