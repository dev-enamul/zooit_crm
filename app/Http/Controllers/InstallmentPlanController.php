<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\InstallmentPlan;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InstallmentPlanController extends Controller
{
    public function create($id){
        $id = decrypt($id);
        $customer = Customer::find($id);
        $installments = InstallmentPlan::where('customer_id',$customer->id)->get();

        if(count($installments)>0){
            return view('payment.installment_plan_show',compact('customer','installments'));
        }else{
            return view('payment.installment_plan',compact('customer','installments'));
        } 
    }

    public function edit($id){
        $id = decrypt($id); 
        $customer = Customer::find($id);
        $installments = InstallmentPlan::where('customer_id',$customer->id)->get(); 
        return view('payment.installment_plan',compact('customer','installments')); 
    }

    public function store(Request $request){  
        $request->validate([
            'customer_id' => 'required|exists:customers,id', 
            'installment_amount' => 'required|array|min:1',
            'installment_amount.*' => 'required|numeric|min:0',  
            'installment_date' => 'required|array|min:1',
            'installment_date.*' => 'required|date', 
        ]);
     
        $customerId = $request->customer_id; 
        $project = Project::where('customer_id',$customerId)->first();  

        $installments = InstallmentPlan::where('customer_id',$customerId)->get();
        if($installments){
            foreach($installments as $installment){
                $installment->delete();
            }
        }
     
        foreach ($request->installment_amount as $index => $amount) {
            InstallmentPlan::create([
                'customer_id' => $customerId,  
                'project_id' => $project->id,  
                'payment_date' => $request->installment_date[$index],
                'amount' => $amount, 
            ]);

            if (Carbon::parse($request->installment_date[$index])->isSameDay(today())) {
                app(DailyJobController::class)();
            }
        } 

      

        return redirect()->route('install.payment',encrypt($customerId))->with('success', 'Installments saved successfully.');
    }
}
