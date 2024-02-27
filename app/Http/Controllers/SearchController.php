<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request){
        $key = $request->key; 
        if($key == null){
            return redirect()->back()->with('error','Please enter a valid keyword');
        }
        $key = strtolower($key); 
        if(strpos($key,'cus-')!==false){ 
            $customer = Customer::where('customer_id',$key)->first();
            if($customer == null){
                return redirect()->back()->with('error','Invalid customer id');
            } 
            return redirect()->route('customer.profile',encrypt($customer->id));
        }

        if(strpos($key,'emp-')!==false){
            $employee = User::where('user_id',$key)->first();
            if($employee == null){
                return redirect()->back()->with('error','Invalid employee id');
            }
            return redirect()->route('profile',encrypt($employee->id));
        }

        if(strpos($key,'fl-')!==false){ 
            $freelancer = User::where('user_id',$key)->first();
            if($freelancer == null){
                return redirect()->back()->with('error','Invalid freelancer id');
            }
            return redirect()->route('profile',encrypt($freelancer->id));
        }

        $datas = User::where('name','like','%'.$key.'%')
            ->orWhere('phone','like','%'.$key.'%')
            ->whereHas('userContact',function($q) use($key){
                $q->orWhere('office_phone','like','%'.$key.'%')
                ->orWhere('personal_phone','like','%'.$key.'%')
                ->orWhere('office_email','like','%'.$key.'%')
                ->orWhere('personal_email','like','%'.$key.'%');
            })
            ->whereHas('userId',function($q) use($key){
                $q->orWhere('nid_number','like','%'.$key.'%')
                ->orWhere('passport_number','like','%'.$key.'%')
                ->orWhere('birth_cirtificate_number','like','%'.$key.'%')
                ->orWhere('tin_number','like','%'.$key.'%');
            })
            ->get();
        return view('search',compact('datas','key'));
    }
}
