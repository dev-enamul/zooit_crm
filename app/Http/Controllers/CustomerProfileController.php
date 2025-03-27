<?php

namespace App\Http\Controllers;

use App\Events\Message;
use App\Events\Notice;
use App\Models\ColdCalling;
use App\Models\Customer;
use App\Models\Deposit;
use App\Models\Designation;
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
use App\Models\UserContact;
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
            $communication['prospecting'] = Prospecting::where('customer_id', $id)->first();
            $communication['cold_calling'] = ColdCalling::where('customer_id', $id)->first();
            $communication['lead'] = Lead::where('customer_id', $id)->first(); 
            $communication['presentation'] = Presentation::where('customer_id', $id)->first(); 
            $communication['follow_up'] = FollowUp::where('customer_id', $id)->latest()->get(); 
            $communication['negotiation'] = Negotiation::where('customer_id', $id)->first(); 
            $communication['rejection'] = Rejection::where('customer_id', $id)->first(); 
            $communication['salse_return'] = SalseReturn::where('customer_id', $id)->first();  

             
            $user = User::find(auth()->user()->id);
            $message = "Customer Profile Viewed";
            $user->notify(new NewMessageNotification($message));  

            $contacts = UserContact::where('user_id',$customer->user_id)->get();
            $designations = Designation::where('status',1)->get();
            return view('customer.customer_profile',compact([
                'designations',
                'customer',    
                'contacts',
                'communication' 
            ]));
        }catch(Exception $e){ 
            return redirect()->back()->with('error',$e->getMessage());
        }
    } 

 
}
