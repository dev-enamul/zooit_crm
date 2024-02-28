<?php

namespace App\Http\Controllers;

use App\Enums\Priority;
use App\Enums\UnitFacility;
use App\Models\Customer;
use App\Models\Negotiation;
use App\Models\NegotiationAnalysis;
use App\Models\Project;
use App\Models\ProjectUnit;
use App\Models\Salse;
use App\Models\Unit;
use App\Models\UnitPrice;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SalseController extends Controller
{
    public function priority()
    {
        return Priority::values();
    }

    public function facility()
    {
        return UnitFacility::values();
    }

    public function index()
    {
        $my_all_employee = my_all_employee(Auth::user()->id);
        $datas = Salse::whereHas('customer',function($q) use($my_all_employee){
            $q->whereIn('ref_id',$my_all_employee);
        })->get();
        return view('salse.salse_list',compact('datas'));
    }



    public function create(Request $request)
    {
        $title              = 'Sales Entry';
        $user_id            = Auth::user()->id; 
        $my_all_employee    = my_all_employee($user_id);
        $customers          = NegotiationAnalysis::where('status',0)->where('approve_by','!=',null)->whereHas('customer',function($q) use($my_all_employee){
                                    $q->whereIn('ref_id',$my_all_employee);
                                })->get();
        $projects           = Project::where('status',1)->get(['name', 'id']);
        $projectUnits       = ProjectUnit::where('status', 1)->get(['name', 'id']);
        $employees          = User::whereIn('id', $my_all_employee)->get();
        $priorities         = $this->priority();
        $facilities         = $this->facility();
        $units              = Unit::all();
        $unit_prices        = UnitPrice::all();
        
        $selected_data = 
        [
            'employee' => Auth::user()->id,
            'priority' => Priority::Regular,
        ];
        if ($request->has('customer')) {
            $selected_data['customer'] = $request->customer;

            $neg_project = NegotiationAnalysis::where('customer_id',$request->customer)->first();

            $selected_data['project'] = $neg_project->project_id;
            $selected_data['unit']  = $neg_project->unit_id;
            $selected_data['payment_duration'] = UnitPrice::find($neg_project->payment_duration);
            $selected_data['select_type']   = 2;
            $selected_data['project_units'] = json_decode($neg_project->project_units); 
            $u_id= Unit::find($neg_project->unit_id);
            $selected_data['booking']  = $u_id->booking;
            $selected_data['down_payment']  = $u_id->down_payment; 

            if (!is_array($selected_data['project_units'])) {
                $selected_data['project_units'] = [];
            }
        }

        return view('salse.salse_save', compact([
            'facilities',
            'unit_prices',
            'units',
            'selected_data',
            'priorities',
            'projects',
            'projectUnits',
            'customers',
            'employees'
        ]));
    }

    public function store(Request $request)
    {
        $rules = [
            'customer' => 'required',
            'employee' => 'required',
            'project' => 'required',
            'unit' => 'required',
            'select_type' => 'required',
            'unit_qty' => 'required|numeric|min:1',
            'payment_duration' => 'required|numeric|min:1',
            'sold_value' => 'required|numeric|min:0',
            'down_payment_pay' => 'required|numeric|min:0', 
            'installment_type' => 'required',
            'total_installment' => 'required|numeric|min:1',
            'installment_value' => 'required|numeric|min:0',
            'facility' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator)->with('error', $validator->errors()->first());
        }

        try{
            $sales = new Salse();
            $customer = Customer::find($request->input('customer'));
            if(!$customer){
                return redirect()->back()->withInput()->with('error', 'Customer not found');
            }  
            
            $sales->customer_id = $customer->id;
            $sales->customer_user_id = $customer->user_id; 
            $sales->project_id = $request->input('project');
            $sales->unit_id = $request->input('unit');
            $sales->payment_duration = $request->input('payment_duration');  
            $sales->select_type = $request->input('select_type');
            if($request->input('select_type') == 1){
                $sales->project_units = json_encode($request->project_unit);
                $sales->unit_qty = count($request->project_unit);
            }else{
                $sales->unit_qty = $request->input('unit_qty');
            }  
            $sales->regular_amount = $request->input('regular_amount');
            $sales->sold_value = $request->input('sold_value');
            $sales->down_payment = $request->input('down_payment');
            $sales->down_payment_due = $request->input('down_payment');
            $sales->booking = $request->input('booking'); 
            $sales->booking_due = $request->input('booking');
            $sales->installment_type = $request->input('installment_type');
            $sales->total_installment = $request->input('total_installment');
            $sales->installment_value = $request->input('installment_value');
            $sales->facility = $request->input('facility');
            $sales->is_investment_package = $request->input('is_investment_package') ?? 0;
            $sales->employee_id = $request->input('employee');
            $sales->created_by = Auth::user()->id; 
            $sales->save(); 
            return redirect()->route('salse.index')->with('success', 'Sales created successfully'); 
        }catch(Exception $e){
            dd($e->getMessage());
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

}
