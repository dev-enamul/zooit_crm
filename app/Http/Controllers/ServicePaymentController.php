<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ServicePaymentController extends Controller
{
    public function create($id){
        $id = decrypt($id);
        $customer = Customer::find($id);
        $payment = SubscriptionPlan::where('customer_id',$id)->with('details')->first(); 
        if($payment){
            return view('payment.subscription_plan_show',compact('customer','payment'));
        }else{
            return view('payment.subscription_plan',compact('customer','payment'));
        } 
    }

    public function storeOrUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'package_type' => 'required|in:1,2',
            'start_from' => 'required|date',
            'reason' => 'required|array',
            'reason.*' => 'required|string|max:255',
            'amount' => 'required|array',
            'amount.*' => 'required|numeric|min:0.01',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator)->with('error', $validator->errors()->first());
        } 
        DB::beginTransaction(); 
        try {
            $customer = Customer::findOrFail($request->customer_id);

            $subscription_plan = SubscriptionPlan::firstOrNew([
                'customer_id' => $customer->id,
            ]); 

            $subscription_plan->user_id = $customer->user_id;
            $subscription_plan->customer_id = $customer->id;
            $subscription_plan->project_id = $customer->project->id;
            $subscription_plan->package_type = $request->package_type;
            $subscription_plan->next_payment_date = $request->start_from;
            $subscription_plan->amount = array_sum($request->amount);
            $subscription_plan->remark = $request->remark;
            $subscription_plan->save();

            if ($subscription_plan->wasRecentlyCreated === false) {
                $subscription_plan->details()->delete();
            }

            foreach ($request->reason as $index => $reason) {
                $subscription_plan->details()->create([
                    'reason' => $reason,
                    'amount' => $request->amount[$index],
                ]);
            } 

            DB::commit();
 
            return redirect()->route('service.payment', encrypt($customer->id))
                ->with('success', 'Subscription Plan ' . ($subscription_plan->wasRecentlyCreated ? 'Created' : 'Updated'));
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Something went wrong! ' . $e->getMessage());
        }
    }  

    public function edit($id){
        $id = decrypt($id);
        $payment = SubscriptionPlan::with('details')->find($id);
        $customer = $payment->customer;
        return view('payment.subscription_plan',compact('customer','payment'));
    }
}
