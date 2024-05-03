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
use App\Models\UnitCategory;
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
        $my_all_employee = json_decode(Auth::user()->user_employee);
        $datas = Salse::whereHas('customer',function($q) use($my_all_employee){
            $q->whereIn('ref_id',$my_all_employee);
        })->get();
        return view('salse.salse_list',compact('datas'));
    }



    public function create(Request $request)
    {
        $title              = 'Sales Entry';
        $user_id            = Auth::user()->id;  

        $projects           = Project::where('status',1)->get(['name', 'id']);
        $projectUnits       = ProjectUnit::where('status', 1)->get(['name', 'id']); 
        $priorities         = $this->priority();
        $facilities         = $this->facility();
        $units              = Unit::all(); 
        $unit_categories    = UnitCategory::all();
        
        $selected_data['priority'] = Priority::Regular; 
        
        if ($request->has('customer')) {
            $selected_data['customer'] = Customer::find($request->customer);

            $neg_project = NegotiationAnalysis::where('customer_id',$request->customer)->first();

            $selected_data['project'] = $neg_project->project_id;
            $selected_data['unit']  = $neg_project->unit_id; 
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
            'units',
            'selected_data',
            'priorities',
            'projects',
            'projectUnits',
            'unit_categories'
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
            'payment_duration' => 'required|numeric|min:1',
            'sold_value' => 'required|numeric|min:0', 
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
            $sales->floor = $request->input('floor');
            $sales->unit_category_id = $request->input('unit_category_id');
            $sales->regular_amount = $request->input('regular_amount');
            $sales->sold_value = $request->input('sold_value');
            $sales->down_payment = $request->input('down_payment');
            $sales->down_payment_due = $request->input('down_payment');
            $sales->booking = $request->input('booking'); 
            $sales->booking_due = $request->input('booking');
            $sales->first_payment = $request->input('first_payment');
            $sales->first_payment_date = $request->input('first_payment_date');
            $sales->installment_type = $request->input('installment_type');
            $sales->total_installment = $request->input('total_installment');
            $sales->installment_value = $request->input('installment_value'); 
            $sales->is_investment_package = $request->input('is_investment_package') ?? 0;
            $sales->facility = $request->input('facility');
            $sales->employee_id = $request->input('employee');
            $sales->created_by = Auth::user()->id; 
            $sales->save();
 
            
            if($request->input('select_type') == 1){ 
                // set sold status 1 for selected project_unit 
                 $project_units = $request->project_unit;
                    foreach($project_units as $project_unit){
                        $unit = ProjectUnit::find($project_unit);
                        if($unit->sold_status == 2){
                             $this->book_lottery_unit($unit);
                        }
                        $unit->sold_status = 1;
                        $unit->save();
                    }

            }else{
                $this->book_lottery_unit($sales);
            }

            $negotiation = NegotiationAnalysis::where('customer_id',$customer->id)->first();
            if($negotiation){
                $negotiation->status = 1;
                $negotiation->save();
            } 
 
            return redirect()->route('salse.index')->with('success', 'Sales created successfully'); 
        }catch(Exception $e){ 
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    } 

    public function book_lottery_unit($unit,$limit = 1){
        $unsold_units = ProjectUnit::where(function($q){
            $q->where('sold_status',0)
            ->orWhere('sold_status',3);
        });  
        if(isset($unit->unit_id) && $unit->unit_id != null){
            $unsold_units =  $unsold_units->where('unit_id',$unit->unit_id);
        } 

        if(isset($unit->floor) && $unit->floor != null){
            $unsold_units =  $unsold_units->where('floor',$unit->floor);
        }

        if(isset($unit->unit_category_id) && $unit->unit_category_id != null){
            $unsold_units =  $unsold_units->where('unit_category_id',$unit->unit_category_id);
        } 

        $unsold_units = $unsold_units->take($limit)->get();
        if($unsold_units && $unsold_units->count() <= 0){
            $unsold_units = ProjectUnit::where(function($q){
                $q->where('sold_status',0)
                ->orWhere('sold_status',3);
            }); 
            if(isset($unit->unit_id) && $unit->unit_id != null){
                $unsold_units =  $unsold_units->where('unit_id',$unit->unit_id);
            }
            if(isset($unit->floor) && $unit->floor != null){
                $unsold_units =  $unsold_units->where('floor',$unit->floor);
            } 
            $unsold_units = $unsold_units->take($limit)->get();
        }

        if($unsold_units && $unsold_units->count() <= 0){
            $unsold_units = ProjectUnit::where(function($q){
                $q->where('sold_status',0)
                ->orWhere('sold_status',3);
            }); 
            if(isset($unit->unit_id) && $unit->unit_id != null){
                $unsold_units =  $unsold_units->where('unit_id',$unit->unit_id);
            } 
            $unsold_units = $unsold_units->take($limit)->get();
        }

        foreach ($unsold_units as $unsold_unit) {
            $unsold_unit->sold_status = 2;
            $unsold_unit->save();
        }
    }

    public function customer_data(Request $request){ 
        $negotiation_analysis = NegotiationAnalysis::where('customer_id',$request->customer_id)->first();
        return response()->json($negotiation_analysis); 
    }

    public function salse_details($id){
        try{
            $id = decrypt($id);
            $data = Salse::find($id);
            $ref_employees = user_reporting($data->customer->ref_id);
            $ref_users = User::whereIn('id',$ref_employees)->get();

            $unit_type = $data?->unitCategory?->title;
            $floor_no = $data->floor;
            $unit_no = "";
            if($data->select_type==1){
                $project_unti = json_decode($data->project_units); 
                foreach ($project_unti as $key => $value) {
                    $unit = ProjectUnit::find($value); 
                    if(isset($unit) && $unit!=null){
                        if($key!=0){
                            $unit_type .= ', ';
                            $floor_no .= ', ';
                            $unit_no .= ', ';  
                        }
                        $unit_type .= $unit->unitCategory->title;
                        $floor_no .= $unit->floor;
                        $unit_no .= $unit->name;
                    }
                }
            }

            $unit_data = [
                'unit_type' => $unit_type,
                'floor_no' => $floor_no,
                'unit_no' => $unit_no,
            ];

            if(!$data){
                return redirect()->back()->with('error', 'Sales not found');
            }
            return view('salse.salse_details',compact('data','ref_users','unit_data'));
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Invalid request');
        }
    }

    public function get_salse_info(Request $request){
        $customer_id = $request->customer_id;
        $data = Salse::where('customer_id', $customer_id)
            ->with('customer.user') 
            ->with('project')
            ->with('unit')
            ->with('unitCategory')
            ->latest()
            ->first();

        return response()->json($data); 
    } 


    public function select2_customer(Request $request){
        $request->validate([
            'term' => ['nullable', 'string'],
        ]); 
        $my_all_employee = json_decode(Auth::user()->user_employee);   
        $is_admin = Auth::user()->hasPermission('admin');
        $results = [
            ['id' => '', 'text' => 'Select Product']
        ]; 
       
        if($is_admin){ 
            $users = Customer::query()
                ->where(function ($query) use ($request) {
                    $term = $request->term;
                    $query->where('customer_id', 'like', "%{$term}%")
                        ->orWhere('name', 'like', "%{$term}%");
                })
                ->whereDoesntHave('salse')
                ->select('id', 'name', 'customer_id')
                ->limit(10)
                ->get();  
                
            foreach ($users as $user) {
                $results[] = [
                    'id' => $user->id,
                    'text' => "{$user->name} [{$user->customer_id}]"
                ]; 
            } 
        }else{
            $users = NegotiationAnalysis::where('status',0)->where('approve_by','!=',null)
            ->whereHas('customer',function($q) use($my_all_employee,$request){
                $q->whereIn('ref_id',$my_all_employee)
                ->where(function ($query) use ($request) {
                    $term = $request->term;
                    $query->where('customer_id', 'like', "%{$term}%")
                        ->orWhere('name', 'like', "%{$term}%");
                });
              })->get(); 
              foreach ($users as $user) {
                $results[] = [
                    'id' => $user->customer->id,
                    'text' => "{$user->customer->name} [{$user->customer->customer_id}]"
                ]; 
            }
        }  
       
        
        return response()->json([
            'results' => $results
        ]);
    } 

}
