<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServicePaymentController extends Controller
{
    public function create($id){
        $id = decrypt($id);
        $customer = Customer::find($id);
        $payment = SubscriptionPlan::where('customer_id',$id)->first();
        if($payment){
            return view('payment.subscription_plan_show',compact('customer','payment'));
        }else{
            return view('payment.subscription_plan',compact('customer','payment'));
        }
        
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'reason' => 'required|string|max:255',
            'package_type' => 'required|in:1,2',
            'amount' => 'required|numeric',
            'start_from' => 'required|date',
            'remark' => 'nullable|string',
        ]);  

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator)->with('error', $validator->errors()->first());
        }  
        $subscription_plan = SubscriptionPlan::where('customer_id',$request->customer_id)->first();
        $customer = Customer::find($request->customer_id);
        if(!$subscription_plan){
            $subscription_plan = new SubscriptionPlan();
        }
        $subscription_plan->user_id = $customer->user_id;
        $subscription_plan->customer_id = $customer->id;
        $subscription_plan->project_id = $customer->project->id;
        $subscription_plan->reason = $request->reason;
        $subscription_plan->package_type = $request->package_type;
        $subscription_plan->amount = $request->amount;
        $subscription_plan->next_payment_date = $request->start_from;
        $subscription_plan->remark = $request->remark;
        $subscription_plan->save();
        return redirect()->route('service.payment',encrypt($customer->id))->with('success', 'Subscription Plan Created');
    }
    public function edit($id){
        $id = decrypt($id);
        $payment = SubscriptionPlan::find($id);
        $customer = $payment->customer;
        return view('payment.subscription_plan',compact('customer','payment'));
    }   
}
