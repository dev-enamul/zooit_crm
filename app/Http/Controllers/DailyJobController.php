<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\InstallmentPlan;
use App\Models\Invoice;
use App\Models\SubscriptionPlan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DailyJobController extends Controller
{
    public function __invoke()
    {
        $installment_plans = InstallmentPlan::whereDate('payment_date', today())->get(); 
        if(isset($installment_plans) && count($installment_plans)>0){ 
            foreach ($installment_plans as $installment_plan) {
                $customer = Customer::find($installment_plan->customer_id); 
                if (!$customer) {
                    continue;
                }   
                $invoice = new Invoice();
                $invoice->user_id = $customer->user_id;
                $invoice->customer_id = $customer->id;
                $invoice->project_id = $installment_plan->project_id;
                $invoice->title = "Project Bill";
                $invoice->description = $customer->service->service ?? 'No service description available';
                $invoice->invoice_date = now();
                $invoice->due_date = now()->addDays(10); // Correct syntax
                $invoice->amount = $installment_plan->amount;
                $invoice->total_amount = $installment_plan->amount;
                $invoice->due_amount = $installment_plan->amount;
                $invoice->save();
            }  
        }

        $subscription_plans = SubscriptionPlan::where('next_payment_date',today())->get(); 
        foreach ($subscription_plans as $subscription_plan) {
            $customer = Customer::find($subscription_plan->customer_id); 
            if (!$customer) {
                continue;
            }   
            $invoice = new Invoice();
            $invoice->user_id = $subscription_plan->user_id;
            $invoice->customer_id = $subscription_plan->customer_id;
            $invoice->project_id = $subscription_plan->project_id;
            $invoice->title = $customer->service->service ?? 'No service description available';
            $invoice->description = $subscription_plan->reason;
            $invoice->invoice_date = now();
            $invoice->due_date = now()->addDays(10);  
            $invoice->amount = $subscription_plan->amount;
            $invoice->total_amount = $subscription_plan->amount;
            $invoice->due_amount = $subscription_plan->amount;
            $invoice->save();

            if ($subscription_plan->next_payment_date) {
                $nextPaymentDate = Carbon::parse($subscription_plan->next_payment_date); 
                if ($subscription_plan->package_type == 1) {
                    $subscription_plan->next_payment_date = $nextPaymentDate->addYear();
                } elseif ($subscription_plan->package_type == 2) {
                    $subscription_plan->next_payment_date = $nextPaymentDate->addMonth();
                }
            }
        }  
       

    }
}
