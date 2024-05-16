<?php

namespace App\Http\Controllers;

use App\DataTables\LeadAnalysisDataTable;
use App\Enums\Religion;
use App\Models\ApproveSetting;
use App\Models\ColdCalling;
use App\Models\Customer;
use App\Models\Lead;
use App\Models\LeadAnalysis;
use App\Models\Notification;
use App\Models\Presentation;
use App\Models\Project;
use App\Models\Unit;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class LeadAnalysisController extends Controller {

    public function index(LeadAnalysisDataTable $dataTable, Request $request) {
        $title      = 'Lead Analysis List';
        $date       = $request->date ?? null;
        $status     = $request->status ?? 0;
        $start_date = Carbon::parse($date ? explode(' - ', $date)[0] : date('Y-m-01'))->format('Y-m-d');
        $end_date   = Carbon::parse($date ? explode(' - ', $date)[1] : date('Y-m-t'))->format('Y-m-d');
        $employee   = $request->employee ?? null;
        $employee   = $employee ? User::find($employee) ?? User::find(auth()->user()->id) : User::find(auth()->user()->id);
        return $dataTable->render('lead_analysis.lead_analysis_list', compact('title', 'employee', 'status', 'start_date', 'end_date'));
    }

    public function religion() {
        return Religion::values();
    }

    public function create(Request $request) {
        try {
            $title                     = 'Lead Analysis Entry';
            $user_id                   = Auth::user()->id;
            $projects                  = Project::where('status', 1)->select('id', 'name')->get();
            $units                     = Unit::select('id', 'title')->get();
            $selected_data['customer'] = Customer::find($request->customer);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
        return view('lead_analysis.lead_analysis_save', compact('title', 'projects', 'units', 'selected_data'));
    }

    public function customer_data(Request $request) {
        $lead = Lead::where('customer_id', $request->customer)->first();
        return response()->json($lead, 200);

    }

    public function save(Request $request, $id = null) {
        $validator = Validator::make($request->all(), [
            'customer'            => ['required', 'numeric'],
            'employee'            => ['required', 'numeric'],
            'project'             => ['required', 'numeric'],
            'unit'                => ['required', 'numeric'],
            'hobby'               => ['nullable', 'string', 'max:255'],
            'income_range'        => ['nullable', 'numeric'],
            'profession_year'     => ['nullable', 'numeric'],
            'customer_need'       => ['nullable', 'string', 'max:255'],
            'tentative_amount'    => ['nullable', 'numeric'],
            'facebook_id'         => ['nullable', 'string', 'max:255'],
            'customer_problem'    => ['nullable', 'string', 'max:255'],
            'refferal'            => ['nullable', 'string', 'max:255'],
            'influencer'          => ['nullable', 'string', 'max:255'],
            'family_member'       => ['nullable', 'numeric'],
            'decision_maker'      => ['nullable', 'string', 'max:255'],
            'previous_experiance' => ['nullable', 'string', 'max:255'],
            'instant_investment'  => ['nullable', 'string', 'max:255'],
            'buyer'               => ['nullable', 'string', 'max:255'],
            'area'                => ['nullable', 'string', 'max:255'],
            'consumer'            => ['nullable', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator)->with('error', $validator->errors()->first());
        }

        if (!empty($id)) {
            $cold_calling = LeadAnalysis::find($id);
            $cold_calling->update([
                'customer_id'         => $request->customer,
                'employee_id'         => $request->employee,
                'project_id'          => $request->project,
                'unit_id'             => $request->unit,
                'hobby'               => $request->hobby,
                'income_range'        => $request->income_range,
                'religion'            => $request->religion,
                'profession_year'     => $request->profession_year,
                'customer_need'       => $request->customer_need,
                'tentative_amount'    => $request->tentative_amount,
                'facebook_id'         => $request->facebook_id,
                'customer_problem'    => $request->customer_problem,
                'referral'            => $request->referral,
                'influencer'          => $request->influencer,
                'family_member'       => $request->family_member,
                'decision_maker'      => $request->decision_maker,
                'previous_experience' => $request->previous_experience,
                'instant_investment'  => $request->instant_investment,
                'buyer'               => $request->buyer,
                'area'                => $request->area,
                'consumer'            => $request->consumer,
                'updated_by'          => auth()->id(),
                'updated_at'          => now(),
            ]);
            return redirect()->route('lead-analysis.index')->with('success', 'Lead Analysis update successfully');

        } else {

            $approve_setting = ApproveSetting::where('name', 'lead_analysis')->first();
            $is_admin        = Auth::user()->hasPermission('admin');
            if ($approve_setting?->status == 0 || $is_admin) {
                $approve_by = auth()->user()->id;
            } else {
                $approve_by = null;
                $employee   = User::find($request->employee);
                if (!empty($employee) && count(json_decode($employee->user_reporting)) > 1) {
                    Notification::store([
                        'title'      => 'Lead analysis approval request',
                        'content'    => auth()->user()->name . ' has created a lead analysis please approve as soon as possible',
                        'link'       => route('lead-analysis.approve'),
                        'created_by' => auth()->user()->id,
                        'user_id'    => [json_decode($employee->user_reporting)[1]],
                    ]);
                }
            }

            $lead_analysis = LeadAnalysis::create([
                'customer_id'         => $request->customer,
                'employee_id'         => $request->employee,
                'project_id'          => $request->project,
                'unit_id'             => $request->unit,
                'hobby'               => $request->hobby,
                'income_range'        => $request->income_range,
                'religion'            => $request->religion,
                'profession_year'     => $request->profession_year,
                'customer_need'       => $request->customer_need,
                'tentative_amount'    => $request->tentative_amount,
                'facebook_id'         => $request->facebook_id,
                'customer_problem'    => $request->customer_problem,
                'referral'            => $request->referral,
                'influencer'          => $request->influencer,
                'family_member'       => $request->family_member,
                'decision_maker'      => $request->decision_maker,
                'previous_experience' => $request->previous_experience,
                'instant_investment'  => $request->instant_investment,
                'buyer'               => $request->buyer,
                'area'                => $request->area,
                'status'              => 0,
                'consumer'            => $request->consumer,
                'created_by'          => auth()->id(),
                'approve_by'          => $approve_by,
                'created_at'          => now(),
            ]);
            $lead = Lead::where('customer_id', $request->customer)->first();
            if (isset($lead) && $lead != null) {
                $lead->status = 1;
                $lead->save();
            }
            return redirect()->route('lead-analysis.index')->with('success', 'Lead Analysis create successfully');
        }
    }

    public function edit(string $id) {
        $title           = 'Lead Analysis Entry';
        $my_all_employee = json_decode(Auth::user()->user_employee);
        $cstmrs          = Lead::where('status', 0)->where('approve_by', '!=', null)->whereHas('customer', function ($q) use ($my_all_employee) {
            $q->whereIn('ref_id', $my_all_employee);
        })->get();

        $projects      = Project::where('status', 1)->select('id', 'name')->get();
        $units         = Unit::select('id', 'title')->get();
        $religions     = $this->religion();
        $lead_analysis = LeadAnalysis::find($id);
        return view('lead_analysis.lead_analysis_save', compact('title', 'cstmrs', 'projects', 'units', 'religions', 'lead_analysis'));
    }

    public function leadAnalysisDelete($id) {
        try {
            $data = LeadAnalysis::find($id);
            $data->delete();
            return response()->json(['success' => 'Lead Analysis Deleted'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function leadAnalysisApprove() {
        $user_id     = Auth::user()->id;
        $my_employee = my_employee($user_id);
        $leads       = LeadAnalysis::where('approve_by', null)->whereIn('employee_id', $my_employee)->orderBy('id', 'desc')->get();
        return view('lead_analysis.lead_analysis_approve', compact('leads'));
    }

    public function leadAnalysisApproveSave(Request $request) {
        if ($request->has('lead_id') && $request->lead_id !== '' & $request->lead_id !== null) {
            DB::beginTransaction();
            try {
                foreach ($request->lead_id as $key => $lead_id) {
                    $lead             = LeadAnalysis::where('id', $lead_id)->first();
                    $lead->approve_by = Auth::user()->id;
                    $lead->save();
                }
                DB::commit();
                return redirect()->route('lead-analysis.approve')->with('success', 'Status Updated Successfully');
            } catch (Exception $e) {
                DB::rollback();
                return redirect()->back()->withInput()->with('error', $e->getMessage());
            }

        } else {
            return redirect()->route('lead-analysis.approve')->with('error', 'Something went wrong!');
        }

    }

    public function lead_analysis_details($id) {
        $id       = decrypt($id);
        $data     = LeadAnalysis::find($id);
        $customer = Customer::find($data->customer_id);
        $user     = User::find($customer->ref_id);
        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }
        $cold_calling = ColdCalling::where('customer_id', $customer->id)->latest()->select('created_at')->first();
        $presentation = Presentation::where('customer_id', $customer->id)->latest()->select('created_at')->first();

        return view('lead_analysis.lead_analysis_details', compact('data', 'customer', 'user', 'cold_calling', 'presentation'));
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
            $users = Lead::where('status', 0)->where('approve_by', '!=', null)
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
