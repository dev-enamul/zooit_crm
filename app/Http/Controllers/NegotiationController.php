<?php

namespace App\Http\Controllers;

use App\DataTables\NegotiationDataTable;
use App\Enums\Priority;
use App\Models\ApproveSetting;
use App\Models\Customer;
use App\Models\FollowUp;
use App\Models\FollowUpAnalysis;
use App\Models\Negotiation;
use App\Models\Notification;
use App\Models\Project;
use App\Models\ProjectUnit;
use App\Models\Unit;
use App\Models\User;
use App\Models\VisitAnalysis;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class NegotiationController extends Controller {

    public function priority() {
        return Priority::values();
    }

    public function index(NegotiationDataTable $dataTable, Request $request) {
        $title      = 'Negotiation Analysis';
        $date       = $request->date ?? null;
        $status     = $request->status ?? 0;
        $start_date = Carbon::parse($date ? explode(' - ', $date)[0] : date('Y-m-01'))->format('Y-m-d');
        $end_date   = Carbon::parse($date ? explode(' - ', $date)[1] : date('Y-m-t'))->format('Y-m-d');
        $employee   = $request->employee ?? null;
        $employee   = $employee ? User::find($employee) ?? User::find(auth()->user()->id) : User::find(auth()->user()->id);
        return $dataTable->render('negotiation.negotiation_list', compact('title', 'employee', 'status', 'start_date', 'end_date'));
    }

    public function create(Request $request) {
        $title        = 'Negotiation Entry';
        $user_id      = Auth::user()->id; 
        $purchase_possibilitys   = $this->priority(); 
        $selected_data['purchase_possibility'] = Priority::Ziro;
        if ($request->has('customer')) {
            $selected_data['customer'] = Customer::find($request->customer);
        } 
        return view('negotiation.negotiation_save', compact('selected_data', 'purchase_possibilitys'));
    }

    public function customer_data(Request $request) {
        $follow_up_analysis = FollowUpAnalysis::where('customer_id', $request->customer_id)->first();
        return response()->json($follow_up_analysis, 200);
    }

    public function save(Request $request, $id = null) {
        $validator = Validator::make($request->all(), [
            'customer'              => 'required', 
            'purchase_possibility'  => 'required', 
            'sales_date'            => 'required',
            'negotiation_amount'    => 'required',
            'remark'                => 'nullable',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator)->with('error', $validator->errors()->first());
        }

        if (!empty($id)) {
            $follow                         = Negotiation::findOrFail($id);
            $follow->customer_id            = $request->customer;
            $follow->employee_id            = auth()->id();
            $follow->purchase_possibility   = $request->purchase_possibility; 
            $follow->negotiation_amount     = $request->negotiation_amount;
            $follow->remark                 = $request->remark;
            $follow->sales_date             = $request->sales_date;
            $follow->updated_by             = $request->updated_by;
            $follow->updated_at             = $request->updated_at;
            $follow->save();

            $customer = Customer::find($request->customer);
            $customer->purchase_possibility = $request->purchase_possibility; 
            $customer->save();
            return redirect()->route('negotiation.index')->with('success', 'Negotiation update successfully');
        } else {
            $follow                         = new Negotiation();
            $follow->customer_id            = $request->customer;
            $follow->employee_id            = auth()->id();
            $follow->purchase_possibility   = $request->purchase_possibility;    
            $follow->negotiation_amount     = $request->input('negotiation_amount');
            $follow->remark                 = $request->remark;
            $follow->sales_date             = $request->sales_date;

            $approve_setting = ApproveSetting::where('name', 'negotiation')->first();
            $is_admin        = Auth::user()->hasPermission('admin');
            if ($approve_setting?->status == 0 || $is_admin) {
                $follow->approve_by = auth()->user()->id;
            } else {
                $follow->approve_by = null;
                $employee           = User::find($request->employee);
                if (!empty($employee) && count(json_decode($employee->user_reporting)) > 1) {
                    Notification::store([
                        'title'      => 'Negotiation approve request',
                        'content'    => auth()->user()->name . ' has created a negotiation please approve as soon as possible',
                        'link'       => route('negotiation.approve'),
                        'created_by' => auth()->user()->id,
                        'user_id'    => [json_decode($employee->user_reporting)[1]],
                    ]);
                }
            }

            $follow->created_by = auth()->id();
            $follow->created_at = now();
            $follow->status     = 0;
            $follow->save();

            if ($follow) {
                FollowUp::where('customer_id', $request->customer)->update(['status' => 1]);
                $customer = Customer::find($request->customer);
                $customer->purchase_possibility = $request->purchase_possibility;
                $customer->last_stpe = 7; 
                $customer->save();
            }

            return redirect()->route('negotiation.index')->with('success', 'Negotiation create successfully');
        }
    }

    public function edit(string $id, Request $request) {
        $title           = 'Negotiation Edit'; 
        $purchase_possibilitys   = $this->priority();

        $selected_data =
            [
            'employee' => Auth::user()->id,
            'purchase_possibility' => Priority::Ziro,
        ]; 
        $negotiation = Negotiation::find($id); 
        $selected_data['customer'] = $negotiation->customer;
        return view('negotiation.negotiation_save', compact('selected_data', 'purchase_possibilitys', 'negotiation'));
    }

    public function negotiationDelete($id) {
        try {
            $data = Negotiation::find($id);
            $data->delete();
            return response()->json(['success' => 'Negotiation Deleted'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function negotiationApprove() {
        $user_id      = Auth::user()->id;
        $my_employee  = my_employee($user_id);
        $negotiations = Negotiation::where('approve_by', null)->whereIn('employee_id', $my_employee)->orderBy('id', 'desc')->get();
        return view('negotiation.negotiation_approve', compact('negotiations'));
    }

    public function negotiationApproveSave(Request $request) {
        if ($request->has('negotiation_id') && $request->negotiation_id !== '' & $request->negotiation_id !== null) {
            DB::beginTransaction();
            try {
                foreach ($request->negotiation_id as $key => $negotiation_id) {
                    $lead             = Negotiation::where('id', $negotiation_id)->first();
                    $lead->approve_by = Auth::user()->id;
                    $lead->save();
                }
                DB::commit();
                return redirect()->route('negotiation.index')->with('success', 'Successfully Approved');
            } catch (Exception $e) {
                DB::rollback();
                return redirect()->back()->withInput()->with('error', $e->getMessage());
            }

        } else {
            return redirect()->back()->with('error', 'Please select at least one negotiation');
        }
    }

    public function select2_customer(Request $request) {
        $request->validate([
            'term' => ['nullable', 'string'],
        ]);

        $my_all_employee = json_decode(Auth::user()->my_employee);
        $is_admin        = Auth::user()->hasPermission('admin');
        $results         = [
            ['id' => '', 'text' => 'Select Customer'],
        ];

        if ($is_admin) {
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
                    'id'   => $user->id,
                    'text' => "{$user->name} [{$user->customer_id}]",
                ];
            }
        } else {
            $users = FollowUp::where('status', 0)->where('approve_by', '!=', null)
                ->whereHas('customer', function ($q) use ($my_all_employee, $request) {
                    $q->whereIn('ref_id', $my_all_employee)
                        ->where(function ($query) use ($request) {
                            $term = $request->term;
                            $query->where('customer_id', 'like', "%{$term}%")
                                ->orWhere('name', 'like', "%{$term}%");
                        });
                })->get();
            foreach ($users as $user) {
                $results[] = [
                    'id'   => $user->customer->id,
                    'text' => "{$user->customer->name} [{$user->customer->customer_id}]",
                ];
            }
        }

        return response()->json([
            'results' => $results,
        ]);
    }

}
