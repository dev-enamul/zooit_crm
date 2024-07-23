<?php

namespace App\Http\Controllers;

use App\DataTables\ColdCallingDataTable;
use App\Enums\Priority;
use App\Models\ApproveSetting;
use App\Models\ColdCalling;
use App\Models\Customer;
use App\Models\Notification;
use App\Models\Project;
use App\Models\Prospecting;
use App\Models\Unit;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ColdCallingController extends Controller {
    public function priority() {
        return Priority::values();
    }

    public function index(ColdCallingDataTable $dataTable, Request $request) {
        $title      = 'Cold Calling List';
        $date       = $request->date ?? null;
        $status     = $request->status ?? 0;
        $start_date = Carbon::parse($date ? explode(' - ', $date)[0] : date('Y-m-01'))->format('Y-m-d');
        $end_date   = Carbon::parse($date ? explode(' - ', $date)[1] : date('Y-m-t'))->format('Y-m-d');
        $employee   = $request->employee ?? null;
        $employee   = $employee ? User::find($employee) ?? User::find(auth()->user()->id) : User::find(auth()->user()->id);
        return $dataTable->render('cold_calling.cold_calling_list', compact('title', 'employee', 'status', 'start_date', 'end_date'));
    }

    public function create(Request $request) {
        $title         = 'Cold Calling Entry';
        $user_id       = Auth::user()->id;
        $priorities    = $this->priority();
        $projects      = Project::where('status', 1)->select('id', 'name')->get();
        $units         = Unit::select('id', 'title')->get();
        $selected_data =
            [
            'employee' => Auth::user()->id,
            'priority' => Priority::Regular,
        ];
        if ($request->has('customer')) {
            $selected_data['customer'] = Customer::find($request->customer);
        }
        return view('cold_calling.cold_calling_save', compact('title', 'priorities', 'projects', 'units', 'selected_data'));
    }

    public function save(Request $request, $id = null) {
        $validator = Validator::make($request->all(), [
            'customer' => 'required|unique:cold_callings,customer_id,' . $id, 
            'priority' => 'required',
            'lead_date' => 'required',
            'remark'   => 'nullable|string|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator)->with('error', $validator->errors()->first());
        }

        if (!empty($id)) {
            $cold_calling = ColdCalling::find($id);
            $cold_calling->update([
                'customer_id' => $request->customer, 
                'priority' => $request->priority,
                'remark'      => $request->remark, 
                'employee_id' => auth()->user()->id, 
                'lead_date'   => $request->lead_date,
                'updated_by'  => auth()->id(),
                'updated_at'  => now(),
            ]);
            return redirect()->route('cold-calling.index')->with('success', 'Cold Calling update successfully');

        } else {
            $cold_call              = new ColdCalling(); 
            $cold_call->priority    = $request->priority;
            $cold_call->remark      = $request->remark;
            $cold_call->customer_id = $request->customer;
            $cold_call->employee_id = auth()->user()->id; 
            $cold_call->lead_date   = $request->lead_date;
            $cold_call->status      = 0;
            $approve_setting        = ApproveSetting::where('name', 'cold_calling')->first();
            $is_admin               = Auth::user()->hasPermission('admin');
            if ($approve_setting?->status == 0 || $is_admin) {
                $cold_call->approve_by = auth()->user()->id;
            } else {
                $cold_call->approve_by = null;
                $employee              = User::find($request->employee);
                if (!empty($employee) && count(json_decode($employee->user_reporting)) > 1) {
                    Notification::store([
                        'title'      => 'Cold calling approval request',
                        'content'    => auth()->user()->name . ' has created a cold calling please approve as soon as possible',
                        'link'       => route('cold-calling.approve'),
                        'created_by' => auth()->user()->id,
                        'user_id'    => [json_decode($employee->user_reporting)[1]],
                    ]);
                }
            }

            $cold_call->created_by = auth()->id();
            $cold_call->created_at = now();
            $cold_call->save();

            if ($cold_call) {
                $prospecting = Prospecting::where('customer_id', $request->customer)->first(); 
                if (isset($prospecting) && $prospecting != null) {
                    $prospecting->status = 1;
                    $prospecting->save();
                }
            }
            return redirect()->route('cold-calling.index')->with('success', 'Cold Calling create successfully');
        }
    }

    public function edit(string $id) {
        $title = 'Cold Calling Edit';

        $user = Auth::user();
        $my_all_employee = json_decode($user->user_employee);
        if($my_all_employee==null){
            $my_all_employee = [$user->id];
        }
        $cstmrs          = Prospecting::where('status', 0)->where('approve_by', '!=', null)->whereHas('customer', function ($q) use ($my_all_employee) {
            $q->whereIn('ref_id', $my_all_employee);
        })->get();
        $priorities   = $this->priority(); 
        $cold_calling = ColdCalling::find($id);
        $employees    = User::whereIn('id', $my_all_employee)->get();
        $selected_data['customer'] = $cold_calling->customer;
        return view('cold_calling.cold_calling_save', compact('selected_data','title', 'cstmrs', 'priorities', 'cold_calling', 'employees'));
    }

    public function colCallingDelete($id) {
        try {
            $data = ColdCalling::find($id);
            $data->delete();
            return response()->json(['success' => 'Cold Calling Deleted'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function coldCallingApprove() {
        $user_id     = Auth::user()->id;
        $my_employee = my_employee($user_id);
        $cold_callings  = ColdCalling::where('approve_by', null)->whereIn('employee_id',$my_employee)->with('customer')->orderBy('id','desc')->get();
        return view('cold_calling.cold_calling_approve', compact('cold_callings'));
    }

    public function coldCallingApproveSave(Request $request) {
        if ($request->has('cold_calling_id') && $request->cold_calling_id !== '' & $request->cold_calling_id !== null) {
            DB::beginTransaction();
            try {
                foreach ($request->cold_calling_id as $key => $cold_calling_id) {
                    $prospecting             = ColdCalling::where('id', $cold_calling_id)->first();
                    $prospecting->approve_by = Auth::user()->id;
                    $prospecting->save();
                }
                DB::commit();
                return redirect()->route('cold-calling.approve')->with('success', 'Status Updated Successfully');
            } catch (Exception $e) {
                DB::rollback();
                return redirect()->back()->withInput()->with('error', $e->getMessage());
            }

        } else {
            return redirect()->route('cold-calling.approve')->with('error', 'Something went wrong!');
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
            $users = Prospecting::where('status', 0)->where('approve_by', '!=', null)
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
