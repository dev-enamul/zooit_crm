<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\InstallmentPlan;
use App\Models\Invoice;
use App\Models\InvoiceDetails;
use App\Models\SubscriptionPlan;
use App\Models\SubscriptionPlanDetails;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DailyJobController extends Controller
{
    public function __invoke()
    {
        DB::beginTransaction();

        try { 
            $installment_plans = InstallmentPlan::whereDate('payment_date','<=', today())->where('is_invoiced',0)->get();
    
            if ($installment_plans->isNotEmpty()) {
                foreach ($installment_plans as $installment_plan) {
                    $customer = Customer::find($installment_plan->customer_id);  
    
                    $invoice = new Invoice();
                    $invoice->user_id = $customer->user_id;
                    $invoice->customer_id = $customer->id;
                    $invoice->project_id = $installment_plan->project_id;
                    $invoice->title = "Project Bill";
                    $invoice->description = $customer->service->service ?? 'No service description available';
                    $invoice->invoice_date = $installment_plan->payment_date;
                    $invoice->due_date = now()->addDays(10);
                    $invoice->amount = $installment_plan->amount;
                    $invoice->total_amount = $installment_plan->amount;
                    $invoice->due_amount = $installment_plan->amount;
                    $invoice->save();

                    $installment_plan->is_invoiced = 1;
                    $installment_plan->save();
                }
            }
    
            // Handle Subscription Plans
            $subscription_plans = SubscriptionPlan::where('next_payment_date','<=', today())->get(); 
      
            foreach ($subscription_plans as $subscription_plan) {
                $customer = Customer::find($subscription_plan->customer_id); 
               
    
                $plan_details = SubscriptionPlanDetails::where('subscription_plan_id', $subscription_plan->id)->get();
    
                if ($subscription_plan->next_payment_date) {
                    $nextPaymentDate = Carbon::parse($subscription_plan->next_payment_date); 
                    if ($subscription_plan->package_type == 1) {
                        $title = $customer->service->service." # ".get_date($subscription_plan->next_payment_date,"Y");
                        $subscription_plan->next_payment_date = $nextPaymentDate->addYear();
                    } elseif ($subscription_plan->package_type == 2) {
                        $title = $customer->service->service." # ".get_date($subscription_plan->next_payment_date,"M-Y");
                        $subscription_plan->next_payment_date = $nextPaymentDate->addMonth();
                    }
                }

                $invoice = new Invoice();
                $invoice->user_id = $subscription_plan->user_id;
                $invoice->customer_id = $subscription_plan->customer_id;
                $invoice->project_id = $subscription_plan->project_id;
                $invoice->title = $title ?? 'No service description available';
                $invoice->description = null;
                $invoice->invoice_date = $subscription_plan->next_payment_date;
                $invoice->due_date = now()->addDays(10);
                $invoice->amount = 0;
                $invoice->total_amount = 0;
                $invoice->due_amount = 0;
                $invoice->save();
    
                $total_amount = 0;
                if ($plan_details->isNotEmpty()) {
                    foreach ($plan_details as $plan_detail) {
                        $total_amount += $plan_detail->amount;
                        InvoiceDetails::create([
                            'invoice_id' => $invoice->id,
                            'reason' => $plan_detail->reason,
                            'amount' => $plan_detail->amount
                        ]);
                    }
                }
    
                $invoice->amount = $total_amount;
                $invoice->total_amount = $total_amount;
                $invoice->due_amount = $total_amount;
                $invoice->save(); 
    
                
                $subscription_plan->save();
            }
    
            DB::commit();
    
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Invoice generation failed: " . $e->getMessage()); 
            throw $e;
        }

    }
}
