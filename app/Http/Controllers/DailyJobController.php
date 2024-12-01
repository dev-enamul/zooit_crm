<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\InstallmentPlan;
use App\Models\Invoice;
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
       

    }
}
