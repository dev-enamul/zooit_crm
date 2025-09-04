<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\InstallmentPlan;
use App\Models\Project;
use App\Models\SubscriptionPlan;
use App\Models\SubscriptionPlanDetails;
use App\Services\InvoiceService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DailyJobController extends Controller
{
    protected $invoiceService;

    public function __construct(InvoiceService $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }

    public function __invoke()
    {
        DB::beginTransaction();
        try {
            $this->handleInstallmentPlans();
            $this->handleSubscriptionPlans();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Invoice generation failed: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Installment Plan invoice generate
     */
    private function handleInstallmentPlans()
    {
        $installment_plans = InstallmentPlan::whereDate('payment_date', '<=', today())
                            ->where('is_invoiced', 0)
                            ->get();

        foreach ($installment_plans as $plan) {
            $customer = Customer::find($plan->customer_id);
            $project  = Project::find($plan->project_id);

            if (!$customer || !$project) {
                continue;
            }

            $this->invoiceService->createInvoice([
                'user_id'      => $customer->user_id,
                'customer_id'  => $customer->id,
                'project_id'   => $plan->project_id,
                'title'        => 'Project Bill',
                'description'  => $customer->service->service ?? 'No service description available',
                'invoice_date' => $plan->payment_date,
                'due_date'     => now()->addDays(10),
                'amount'       => $plan->amount,
            ]);

            $plan->is_invoiced = 1;
            $plan->save();
        }
    }  
    
    private function handleSubscriptionPlans()
    {
        $subscription_plans = SubscriptionPlan::where('next_payment_date', '<=', today())->get();

        foreach ($subscription_plans as $plan) {
            $customer = Customer::find($plan->customer_id);
            $project  = Project::find($plan->project_id);

            if (!$customer || !$project) {
                continue;
            }

            // Payment cycle update
            $nextPaymentDate = Carbon::parse($plan->next_payment_date);
            if ($plan->package_type == 1) { // yearly
                $title = $customer->service->service . " # " . get_date($plan->next_payment_date, "Y");
                $plan->next_payment_date = $nextPaymentDate->addYear();
            } elseif ($plan->package_type == 2) { // monthly
                $title = $customer->service->service . " # " . get_date($plan->next_payment_date, "M-Y");
                $plan->next_payment_date = $nextPaymentDate->addMonth();
            } else {
                $title = $customer->service->service ?? 'No service description available';
            }

            // Subscription invoice তৈরি
            $details = SubscriptionPlanDetails::where('subscription_plan_id', $plan->id)->get();

            $total_amount = $details->sum('amount');

            $invoice = $this->invoiceService->createInvoice([
                'user_id'      => $plan->user_id,
                'customer_id'  => $plan->customer_id,
                'project_id'   => $plan->project_id,
                'title'        => $title,
                'invoice_date' => $plan->next_payment_date,
                'due_date'     => now()->addDays(10),
                'amount'       => $total_amount,
            ], $details->map(function ($detail) {
                return [
                    'reason' => $detail->reason,
                    'amount' => $detail->amount,
                ];
            })->toArray());

            $plan->save();
        }
    }
}
