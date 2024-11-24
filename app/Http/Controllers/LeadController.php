<?php

namespace App\Http\Controllers;

use App\DataTables\LeadDataTable;
use App\Enums\Priority;
use App\Models\ApproveSetting;
use App\Models\ColdCalling;
use App\Models\Customer;
use App\Models\Lead;
use App\Models\Notification;
use App\Models\Project;
use App\Models\Unit;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class LeadController extends Controller {

    public function index(LeadDataTable $dataTable, Request $request) {
        $title      = 'Lead List';
        $date       = $request->date ?? null;
        $status     = $request->status ?? 0;
        $start_date = Carbon::parse($date ? explode(' - ', $date)[0] : date('Y-m-01'))->format('Y-m-d');
        $end_date   = Carbon::parse($date ? explode(' - ', $date)[1] : date('Y-m-t'))->format('Y-m-d');
        $employee   = $request->employee ?? null;
        $employee   = $employee ? User::find($employee) ?? User::find(auth()->user()->id) : User::find(auth()->user()->id);
        return $dataTable->render('lead.lead_list', compact('title', 'employee', 'status', 'start_date', 'end_date'));
    }

    public function priority() {
        return Priority::values();
    }

    public function create(Request $request) {
        $title      = 'Lead Entry'; 
        $purchase_possibilitys = $this->priority();

        $selected_data =
            [
            'employee' => Auth::user()->id,
            'purchase_possibility' => Priority::Ziro,
        ];
        if ($request->has('customer')) {
            $selected_data['customer'] = Customer::select('id', 'customer_id', 'name')->find($request->customer);
        }
        return view('lead.lead_save', compact('purchase_possibilitys', 'title', 'selected_data'));
    }

    public function customer_data(Request $request) {
        $cold_calling = ColdCalling::where('customer_id', $request->customer_id)->first();
        return response()->json($cold_calling, 200);
    }

    public function save(Request $request, $id = null) {
        $validator = Validator::make($request->all(), [
            'customer'      => 'required',
            'purchase_possibility'      => 'required',
            'presentation_date' => 'required',
            'remark'        => 'nullable|string|max:255', 
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator)->with('error', $validator->errors()->first());
        }

        if (!empty($id)) {
            $lead = Lead::find($id);
            $lead->update([
                'customer_id'            => $request->customer,
                'purchase_possibility'  => $request->purchase_possibility,
                'remark'                 => $request->remark,
                'employee_id'            => Auth::user()->id,  
                'presentation_date' => date('Y-m-d', strtotime($request->presentation_date)),
                'updated_by'             => auth()->id(),
                'updated_at'             => now(),
                'created_by'             => auth()->id(),
            ]);

            $customer = Customer::find($request->customer);
            $customer->purchase_possibility = $request->purchase_possibility; 
            $customer->save();
            return redirect()->route('lead.index')->with('success', 'Lead update successfully'); 
        } else {
            $lead                         = new Lead();
            $lead->customer_id            = $request->customer;
            $lead->employee_id            = auth()->user()->id; 
            $lead->remark                           = $request->remark; 
            $lead->updated_by                       = auth()->id();
            $lead->purchase_possibility             = $request->purchase_possibility; 
            $lead->presentation_date = date('Y-m-d', strtotime($request->presentation_date));
            $approve_setting              = ApproveSetting::where('name', 'lead')->first();
            $is_admin                     = Auth::user()->hasPermission('admin');
            if ($approve_setting?->status == 0 || $is_admin) {
                $lead->approve_by = auth()->user()->id;
            } else {
                $lead->approve_by = null;
                $employee         = User::find($request->employee);
                if (!empty($employee) && count(json_decode($employee->user_reporting)) > 1) {
                    Notification::store([
                        'title'      => 'Lead approval request',
                        'content'    => auth()->user()->name . ' has created a lead please approve as soon as possible',
                        'link'       => route('lead.approve'),
                        'created_by' => auth()->user()->id,
                        'user_id'    => [json_decode($employee->user_reporting)[1]],
                    ]);
                }
            }
            $lead->status     = 0;
            $lead->created_at = now();
            $lead->save();

            if ($lead) {
                $cold_calling = ColdCalling::where('customer_id', $request->customer)->first();
                if (isset($cold_calling) && $cold_calling != null) {
                    $cold_calling->status = 1;
                    $cold_calling->save();
                }

                $customer = Customer::find($request->customer);
                $customer->purchase_possibility = $request->purchase_possibility;
                $customer->last_stpe = 4; //Cold Calling
                $customer->save();
            }
            return redirect()->route('lead.index')->with('success', 'Lead create successfully');
        }
    }

    public function edit($id) {
        $title           = 'Lead Edit';
        $my_all_employee = json_decode(Auth::user()->user_employee);
        if($my_all_employee==null){
            $my_all_employee = [Auth::user()->id];
        }
        $customers       = Customer::whereIn('ref_id', $my_all_employee)->get(); 
        $purchase_possibilitys      = $this->priority();
        $lead            = Lead::find($id);
        $selected_data['customer'] = $lead->customer; 
        return view('lead.lead_save', compact('selected_data','customers', 'purchase_possibilitys', 'title', 'lead'));
    }

    public function leadDelete($id) {
        try {
            $data = Lead::find($id);
            $data->delete();
            return response()->json(['success' => 'Lead Deleted'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function leadApprove() {
        $user_id     = Auth::user()->id;
        $my_employee = my_employee($user_id);
        $leads       = Lead::where('approve_by', null)->whereIn('employee_id', $my_employee)->orderBy('id', 'desc')->get();
        return view('lead.lead_approve', compact('leads'));
    }

    public function leadApproveSave(Request $request) {
        if ($request->has('lead_id') && $request->lead_id !== '' & $request->lead_id !== null) {
            DB::beginTransaction();
            try {
                foreach ($request->lead_id as $key => $lead_id) {
                    $lead             = Lead::where('id', $lead_id)->first();
                    $lead->approve_by = Auth::user()->id;
                    $lead->save();
                }
                DB::commit();
                return redirect()->route('lead.approve')->with('success', 'Status Updated Successfully');
            } catch (Exception $e) {
                DB::rollback();
                return redirect()->back()->withInput()->with('error', $e->getMessage());
            }

        } else {
            return redirect()->route('lead.approve')->with('error', 'Something went wrong!');
        }

    }

    public function select2_customer(Request $request) {
        $request->validate([
            'term' => ['nullable', 'string'],
        ]);

        $my_all_employee = json_decode(Auth::user()->user_employee);
        $is_admin        = Auth::user()->hasPermission('admin');
        $results         = [
            ['id' => '', 'text' => 'Select Product'],
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
            $users = ColdCalling::where('status', 0)->where('approve_by', '!=', null)
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
