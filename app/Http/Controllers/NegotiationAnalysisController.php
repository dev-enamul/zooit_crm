<?php

namespace App\Http\Controllers;

use App\DataTables\NegotiationAnalysisDataTable;
use App\Enums\Priority;
use App\Models\ApproveSetting;
use App\Models\Customer;
use App\Models\Lead;
use App\Models\Negotiation;
use App\Models\NegotiationAnalysis;
use App\Models\NegotiationWaitingDay;
use App\Models\Notification;
use App\Models\Presentation;
use App\Models\Project;
use App\Models\ProjectUnit;
use App\Models\Unit;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class NegotiationAnalysisController extends Controller {
    public function priority() {
        return Priority::values();
    }

    public function index(NegotiationAnalysisDataTable $dataTable, Request $request) {
        $title      = 'Negotiation Analysis';
        $date       = $request->date ?? null;
        $status     = $request->status ?? 0;
        $start_date = Carbon::parse($date ? explode(' - ', $date)[0] : date('Y-m-01'))->format('Y-m-d');
        $end_date   = Carbon::parse($date ? explode(' - ', $date)[1] : date('Y-m-t'))->format('Y-m-d');
        $employee   = $request->employee ?? null;
        $employee   = $employee ? User::find($employee) ?? User::find(auth()->user()->id) : User::find(auth()->user()->id);
        return $dataTable->render('negotiation_analysis.negotiation_analysis_list', compact('title', 'employee', 'status', 'start_date', 'end_date'));
    }

    public function create(Request $request) {
        $title        = 'Negotiation Analysis Entry';
        $user_id      = Auth::user()->id;
        $projects     = Project::where('status', 1)->get(['name', 'id']);
        $projectUnits = ProjectUnit::where('status', 1)->get(['name', 'id']);
        $priorities   = $this->priority();
        $units        = Unit::select('id', 'title')->get();

        $selected_data['priority'] = Priority::Regular;
        if ($request->has('customer')) {
            $selected_data['customer'] = Customer::find($request->customer);
        }

        return view('negotiation_analysis.negotiation_analysis_save', compact('selected_data', 'priorities', 'projects', 'projectUnits', 'units'));
    }

    public function customer_data(Request $request) {
        $negotiation = Negotiation::where('customer_id', $request->customer_id)->first();
        return response()->json($negotiation);
    }

    public function save(Request $request, $id = null) {
        $validator = Validator::make($request->all(), [
            'customer'            => 'required',
            'employee'            => 'required',
            'priority'            => 'required',
            'project'             => 'required',
            'unit'                => 'required',
            'regular_amount'      => 'required',
            'unit_qty'            => 'required',
            'negotiation_amount'  => 'required',
            'customer_emotion'    => 'nullable',
            'customer_preference' => 'nullable',
            'plan_b'              => 'nullable',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator)->with('error', $validator->errors()->first());
        }

        if (!empty($id)) {
            $follow                      = NegotiationAnalysis::findOrFail($id);
            $follow->customer_id         = $request->customer;
            $follow->employee_id         = $request->employee;
            $follow->priority            = $request->priority;
            $follow->project_id          = $request->input('project');
            $follow->unit_id             = $request->input('unit');
            $follow->select_type         = $request->select_type;
            $follow->payment_duration    = $request->payment_duration;
            $follow->unit_price          = $request->unit_price;
            $follow->unit_qty            = $request->unit_qty;
            $follow->regular_amount      = $request->input('regular_amount');
            $follow->negotiation_amount  = $request->input('negotiation_amount');
            $follow->customer_emotion    = $request->input('customer_emotion');
            $follow->customer_preference = $request->input('customer_preference');
            $follow->plan_b              = $request->input('plan_b');

            $follow->updated_by = $request->updated_by;
            $follow->updated_at = $request->updated_at;
            $follow->save();
            return redirect()->route('negotiation-analysis.index')->with('success', 'Negotiation Analysis update successfully');
        } else {
            $follow                      = new NegotiationAnalysis();
            $follow->customer_id         = $request->customer;
            $follow->employee_id         = $request->employee;
            $follow->priority            = $request->priority;
            $follow->project_id          = $request->input('project');
            $follow->unit_id             = $request->input('unit');
            $follow->select_type         = $request->select_type;
            $follow->payment_duration    = $request->payment_duration;
            $follow->unit_price          = $request->unit_price;
            $follow->unit_qty            = $request->unit_qty;
            $follow->regular_amount      = $request->input('regular_amount');
            $follow->negotiation_amount  = $request->input('negotiation_amount');
            $follow->customer_emotion    = $request->input('customer_emotion');
            $follow->customer_preference = $request->input('customer_preference');
            $follow->plan_b              = $request->input('plan_b');

            $approve_setting = ApproveSetting::where('name', 'negotiation_analysis')->first();
            $is_admin        = Auth::user()->hasPermission('admin');
            if ($approve_setting?->status == 0 || $is_admin) {
                $follow->approve_by = auth()->user()->id;
            } else {
                $follow->approve_by = null;
                $employee           = User::find($request->employee);
                if (!empty($employee) && count(json_decode($employee->user_reporting)) > 1) {
                    Notification::store([
                        'title'      => 'Negotiation analysis approve request',
                        'content'    => auth()->user()->name . ' has created a negotiation analysis please approve as soon as possible',
                        'link'       => route('negotiation-analysis.approve'),
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
                Negotiation::where('customer_id', $request->customer)->update(['status' => 1]);
            }

            return redirect()->route('negotiation-analysis.index')->with('success', 'Negotiation Analysis create successfully');
        }
    }

    public function edit(string $id, Request $request) {
        $title           = 'Negotiation Analysis Edit';
        $my_all_employee = json_decode(Auth::user()->user_employee);
        $customers       = Negotiation::where('status', 0)->where('approve_by', '!=', null)->whereHas('customer', function ($q) use ($my_all_employee) {
            $q->whereIn('ref_id', $my_all_employee);
        })->get();
        $projects     = Project::where('status', 1)->get(['name', 'id']);
        $units       = Unit::select('id', 'title')->get();
        $projectUnits = ProjectUnit::where('status', 1)->get(['name', 'id']);
        $employees    = User::whereIn('id', $my_all_employee)->get();
        $priorities   = $this->priority();

        $selected_data =
            [
            'employee' => Auth::user()->id,
            'priority' => Priority::Regular,
        ]; 
        $negotiation = NegotiationAnalysis::find($id);
        $selected_data['customer']            = $negotiation->customer;
        return view('negotiation_analysis.negotiation_analysis_save', compact('units','selected_data', 'priorities', 'projects', 'projectUnits', 'customers', 'employees', 'negotiation'));

    }

    public function negotiationAnalysisDelete($id) {
        try {
            $data = NegotiationAnalysis::find($id);
            $data->delete();
            return response()->json(['success' => 'Negotiation Analysis Deleted'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function negotiationAnalysisApprove() {
        $user_id      = Auth::user()->id;
        $my_employee  = my_employee($user_id);
        $negotiations = NegotiationAnalysis::where('approve_by', null)->whereIn('employee_id', $my_employee)->orderBy('id', 'desc')->get();
        return view('negotiation_analysis.negotiation_analysis_approve', compact('negotiations'));
    }

    public function negotiationAnalysisApproveSave(Request $request) {
        if ($request->has('negotiation_id') && $request->negotiation_id !== '' & $request->negotiation_id !== null) {
            DB::beginTransaction();
            try {
                foreach ($request->negotiation_id as $key => $negotiation_id) {
                    $lead             = NegotiationAnalysis::where('id', $negotiation_id)->first();
                    $lead->approve_by = Auth::user()->id;
                    $lead->save();
                }
                DB::commit();
                return redirect()->route('negotiation-analysis.index')->with('success', 'Status Updated Successfully');
            } catch (Exception $e) {
                DB::rollback();
                return redirect()->back()->withInput()->with('error', $e->getMessage());
            }

        } else {
            return redirect()->back()->with('error', 'Please select at least one negotiation analysis');
        }
    }

    public function update_waiting_day(Request $request) {
        $validator = Validator::make($request->all(), [
            'waiting_day' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator)->with('error', $validator->errors()->first());
        }

        try {
            $waiting_day = NegotiationWaitingDay::first();
            if (!isset($waiting_day) || $waiting_day == null) {
                $waiting_day = new NegotiationWaitingDay();
            }

            $waiting_day->waiting_day = $request->waiting_day;
            $waiting_day->save();
            return redirect()->back()->with('success', 'Successfully Updated');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

    }

    public function negotiation_analysis_details($id) {
        $id                     = decrypt($id);
        $data                   = NegotiationAnalysis::find($id);
        $last_lead              = Lead::where('customer_id', $data->customer_id)->whereNotNull('approve_by')->select('created_at')->latest()->first();
        $last_presentation_date = Presentation::where('customer_id', $data->customer_id)
            ->whereNotNull('approve_by')
            ->select('created_at')
            ->latest()
            ->first();
        $last_follow_up = Negotiation::where('customer_id', $data->customer_id)
            ->whereNotNull('approve_by')
            ->select('created_at', 'negotiation_amount')
            ->latest()
            ->first();
        return view('negotiation_analysis.negotiation_analysis_details', compact([
            'data',
            'last_lead', 'last_presentation_date', 'last_follow_up',
        ]));
    }

    public function select2_customer(Request $request) {
        $request->validate([
            'term' => ['nullable', 'string'],
        ]);

        $my_all_employee = json_decode(Auth::user()->my_employee);
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
            $users = Negotiation::where('status', 0)->where('approve_by', '!=', null)
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
