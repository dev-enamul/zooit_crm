<?php

namespace App\Http\Controllers;

use App\DataTables\FollowupAnalysisDataTable;
use App\Enums\Priority;
use App\Models\ApproveSetting;
use App\Models\Customer;
use App\Models\FollowUp;
use App\Models\FollowUpAnalysis;
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

class FollowupAnalysisController extends Controller {

    public function priority() {
        return Priority::values();
    }

    public function index(FollowupAnalysisDataTable $dataTable, Request $request) {
        $title      = 'Follow Up Analysis';
        $date       = $request->date ?? null;
        $status     = $request->status ?? 0;
        $start_date = Carbon::parse($date ? explode(' - ', $date)[0] : date('Y-m-01'))->format('Y-m-d');
        $end_date   = Carbon::parse($date ? explode(' - ', $date)[1] : date('Y-m-t'))->format('Y-m-d');
        $employee   = $request->employee ?? null;
        $employee   = $employee ? User::find($employee) ?? User::find(auth()->user()->id) : User::find(auth()->user()->id);
        return $dataTable->render('followup_analysis.followup_analysis_list', compact('title', 'employee', 'status', 'start_date', 'end_date'));
    }

    public function create(Request $request) {
        $title        = 'Follow Up Analysis Entry';
        $user_id      = Auth::user()->id;
        $projects     = Project::where('status', 1)->get(['name', 'id']);
        $projectUnits = ProjectUnit::where('status', 1)->get(['name', 'id']);
        $priorities   = $this->priority();
        $units        = Unit::select('id', 'title')->get();

        $selected_data[] = Priority::Regular;
        if ($request->has('customer')) {
            $selected_data['customer'] = Customer::find($request->customer);
        }
        return view('followup_analysis.followup_analysis_save', compact('selected_data', 'priorities', 'projects', 'projectUnits', 'units'));
    }

    public function customer_data(Request $request) {
        $followup = FollowUp::where('customer_id', $request->customer_id)->first();
        return response()->json($followup);

    }

    public function save(Request $request, $id = null) {
        $validator = Validator::make($request->all(), [
            'customer'               => 'required',
            'employee'               => 'required',
            'priority'               => 'required',
            'project'                => 'required',
            'unit'                   => 'required',
            'unit_qty'               => 'required',
            'regular_amount'         => 'required',
            'negotiation_amount'     => 'nullable',
            'remark'                 => 'nullable',
            'customer_expectation'   => 'nullable',
            'customer_need'          => 'nullable',
            'customer_ability'       => 'nullable',
            'influencer_opinion'     => 'nullable',
            'descision_maker'        => 'nullable',
            'decision_maker_opinion' => 'nullable',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator)->with('error', $validator->errors()->first());
        }

        if (!empty($id)) {
            $follow                         = FollowUpAnalysis::findOrFail($id);
            $follow->customer_id            = $request->customer;
            $follow->employee_id            = $request->employee;
            $follow->priority               = $request->priority;
            $follow->project_id             = $request->input('project');
            $follow->unit_id                = $request->input('unit');
            $follow->unit_price             = $request->unit_price;
            $follow->unit_qty               = $request->unit_qty;
            $follow->regular_amount         = $request->input('regular_amount');
            $follow->negotiation_amount     = $request->input('negotiation_amount');
            $follow->remark                 = $request->remark;
            $follow->customer_expectation   = $request->customer_expectation;
            $follow->need                   = $request->customer_need;
            $follow->ability                = $request->customer_ability;
            $follow->influencer_opinion     = $request->influencer_opinion;
            $follow->decision_maker         = $request->descision_maker;
            $follow->decision_maker_opinion = $request->decision_maker_opinion;

            $follow->updated_by = $request->updated_by;
            $follow->updated_at = $request->updated_at;
            $follow->save();
            return redirect()->route('followup-analysis.index')->with('success', 'Follow Up Analysis update successfully');
        } else {
            $follow                         = new FollowUpAnalysis();
            $follow->customer_id            = $request->customer;
            $follow->employee_id            = $request->employee;
            $follow->priority               = $request->priority;
            $follow->project_id             = $request->input('project');
            $follow->unit_id                = $request->input('unit');
            $follow->unit_price             = $request->unit_price;
            $follow->unit_qty               = $request->unit_qty;
            $follow->regular_amount         = $request->input('regular_amount');
            $follow->negotiation_amount     = $request->input('negotiation_amount');
            $follow->remark                 = $request->remark;
            $follow->customer_expectation   = $request->customer_expectation;
            $follow->need                   = $request->customer_need;
            $follow->ability                = $request->customer_ability;
            $follow->influencer_opinion     = $request->influencer_opinion;
            $follow->decision_maker         = $request->descision_maker;
            $follow->decision_maker_opinion = $request->decision_maker_opinion;

            $approve_setting = ApproveSetting::where('name', 'follow_up_analysis')->first();
            $is_admin        = Auth::user()->hasPermission('admin');
            if ($approve_setting?->status == 0 || $is_admin) {
                $follow->approve_by = auth()->user()->id;
            } else {
                $follow->approve_by = null;
                $employee           = User::find($request->employee);
                if (!empty($employee) && count(json_decode($employee->user_reporting)) > 1) {
                    Notification::store([
                        'title'      => 'Follow up analysis approve request',
                        'content'    => auth()->user()->name . ' has created a follow up analysis please approve as soon as possible',
                        'link'       => route('followUp-analysis.approve'),
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
            }

            return redirect()->route('followup-analysis.index')->with('success', 'Follow Up Analysis create successfully');
        }
    }

    public function edit(string $id, Request $request) {
        $title           = 'Follow Up Analysis Entry';
        $my_all_employee = json_decode(Auth::user()->user_employee);
        $customers       = FollowUp::where('status', 0)->where('approve_by', '!=', null)->whereHas('customer', function ($q) use ($my_all_employee) {
            $q->whereIn('ref_id', $my_all_employee);
        })->get();
        $projects     = Project::where('status', 1)->get(['name', 'id']);
        $projectUnits = ProjectUnit::where('status', 1)->get(['name', 'id']);
        $employees    = User::whereIn('id', $my_all_employee)->get();
        $priorities   = $this->priority();

        $selected_data =
            [
            'employee' => Auth::user()->id,
            'priority' => Priority::Regular,
        ];
        if ($request->has('customer')) {
            $selected_data['customer'] = $request->customer;
        }

        $followUp = FollowUpAnalysis::find($id);
        return view('followup_analysis.followup_analysis_save', compact('followUp', 'selected_data', 'priorities', 'projects', 'projectUnits', 'customers', 'employees'));
    }

    public function followUpDelete($id) {
        try {
            $data = FollowUp::find($id);
            $data->delete();
            return response()->json(['success' => 'Follow Up Deleted'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function followUpApprove() {
        $user_id     = Auth::user()->id;
        $my_employee = my_employee($user_id);
        $followUps   = FollowUpAnalysis::where('approve_by', null)->whereIn('employee_id', $my_employee)->orderBy('id', 'desc')->get();
        return view('followup_analysis.followup_analysis_approve', compact('followUps'));
    }

    public function followUpsApproveSave(Request $request) {
        if ($request->has('followUp_id') && $request->followUp_id !== '' & $request->followUp_id !== null) {
            DB::beginTransaction();
            try {
                foreach ($request->followUp_id as $key => $followUp_id) {
                    $lead             = FollowUpAnalysis::where('id', $followUp_id)->first();
                    $lead->approve_by = Auth::user()->id;
                    $lead->save();
                }
                DB::commit();
                return redirect()->route('followup-analysis.index')->with('success', 'Successfully Approved');
            } catch (Exception $e) {
                DB::rollback();
                return redirect()->back()->withInput()->with('error', $e->getMessage());
            }

        } else {
            return redirect()->back()->with('error', 'Please select at least one record');
        }
    }

    public function follow_analysis_up_details($id) {
        try {
            $id                = decrypt($id);
            $data              = FollowUpAnalysis::find($id);
            $customer          = Customer::find($data->customer_id);
            $user              = User::find($customer->ref_id);
            $employee          = User::find($data->employee_id);
            $presentation_date = Presentation::where('customer_id', $data->customer_id)->select('created_at')->latest()->first();

            $followUps      = FollowUp::where('customer_id', $data->customer_id)->select('created_at')->get();
            $firstFollowUp  = $followUps->first();
            $secondFollowUp = $followUps->slice(1, 1)->first();
            $thirdFollowUp  = $followUps->slice(2, 1)->first();
            $lastFollowUp   = $followUps->last();
            $totalFollowUps = $followUps->count();

        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
        return view('followup_analysis.followup_analysis_details', compact([
            'data',
            'customer',
            'user',
            'employee',
            'presentation_date',
            'followUps',
        ]));

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
