<?php

namespace App\Http\Controllers;

use App\Events\Message;
use App\Events\Notice;
use App\Models\ColdCalling;
use App\Models\Customer;
use App\Models\Deposit;
use App\Models\FollowUp;
use App\Models\FollowUpAnalysis;
use App\Models\Lead;
use App\Models\LeadAnalysis;
use App\Models\Negotiation;
use App\Models\NegotiationAnalysis;
use App\Models\Presentation;
use App\Models\Prospecting;
use App\Models\Rejection;
use App\Models\Salse;
use App\Models\SalseReturn;
use App\Models\SalseTransfar;
use App\Models\User;
use App\Models\VisitAnalysis;
use App\Notifications\NewMessageNotification;
use Exception;
use Illuminate\Http\Request;

class CustomerProfileController extends Controller
{
    public function index($id){  
        try{
            $id = decrypt($id);
            $customer = Customer::find($id); 
            $salseReturn = SalseReturn::where('customer_user_id', $customer->user_id)->whereNotNull('approve_by');
            $salseReturnCount = $salseReturn->count();
            $deductionAmount = $salseReturn->sum('deduction_amount');
            $salesReturnAmount = $salseReturn->sum('sales_return_amount');

            $return_projec_ids = $salseReturn->pluck('project_id')->toArray();

            $sales = Salse::where('customer_user_id', $customer->user_id)->whereNotNull('approve_by')->whereNotIn('project_id', $return_projec_ids); 
            $totalSaleValue = $sales->sum('sold_value');
            $totalSaleCount = $sales->count();
            $totalDeposit = $sales->sum('total_deposit');

            $communication['prospecting'] = Prospecting::where('customer_id', $id)->first();
            $communication['cold_calling'] = ColdCalling::where('customer_id', $id)->first();
            $communication['lead'] = Lead::where('customer_id', $id)->first();
            $communication['lead_analysis'] = LeadAnalysis::where('customer_id', $id)->first();
            $communication['presentation'] = Presentation::where('customer_id', $id)->first();
            $communication['visit_analysis'] = VisitAnalysis::where('customer_id', $id)->first();
            $communication['follow_up'] = FollowUp::where('customer_id', $id)->first();
            $cummunication['follow_up_analysis'] = FollowUpAnalysis::where('customer_id', $id)->first();
            $communication['negotiation'] = Negotiation::where('customer_id', $id)->first();
            $communication['negotiation_analysis'] = NegotiationAnalysis::where('customer_id', $id)->first();
            $communication['rejection'] = Rejection::where('customer_id', $id)->first();
            $communication['salse'] = Salse::where('customer_id', $id)->first();
            $communication['salse_return'] = SalseReturn::where('customer_id', $id)->first(); 

            $customer_salse = Salse::where('customer_id', $id)->whereNotNull('approve_by')->first();

            // event(new Message($id, "Customer Profile Viewed"));

            $user = User::find(auth()->user()->id);
            $message = "Customer Profile Viewed";
            $user->notify(new NewMessageNotification($message));

            return view('customer.customer_profile',compact([
                'customer',
                'totalSaleValue',
                'totalSaleCount',
                'totalDeposit',
                'deductionAmount', 
                'salesReturnAmount',
                'salseReturnCount',
                'communication',
                'customer_salse'
            ]));
        }catch(Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }
    }
}
