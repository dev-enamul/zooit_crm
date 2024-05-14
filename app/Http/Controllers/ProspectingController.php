<?php

namespace App\Http\Controllers;

use App\DataTables\ProspectingDataTable;
use App\Enums\Priority;
use App\Enums\ProspectingMedia;
use App\Models\ApproveSetting;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Notification;
use App\Models\Prospecting;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProspectingController extends Controller {
    public function prospectingMedia() {
        return ProspectingMedia::values();
    }

    public function priority() {
        return Priority::values();
    }

    public function index(ProspectingDataTable $dataTable, Request $request) {
        $title      = 'Prospecting List';
        $date       = $request->date ?? null;
        $status     = $request->status ?? 0;
        $start_date = Carbon::parse($date ? explode(' - ', $date)[0] : date('Y-m-01'))->format('Y-m-d');
        $end_date   = Carbon::parse($date ? explode(' - ', $date)[1] : date('Y-m-t'))->format('Y-m-d');
        $employee   = $request->employee ?? null;
        $employee   = $employee ? User::find($employee) ?? User::find(auth()->user()->id) : User::find(auth()->user()->id);
        return $dataTable->render('prospecting.prospecting_list', compact('title', 'employee', 'status', 'start_date', 'end_date'));
    }

    public function create(Request $request) {
        $title             = 'Prospecting Entry';
        $user_id           = Auth::user()->id;
        $my_all_employee   = json_decode(Auth::user()->user_employee);
        $employees         = User::whereIn('id', $my_all_employee)->get();
        $prospectingMedias = $this->prospectingMedia();
        $priorities        = $this->priority();
        $selected_data     =
            [
            'priority' => Priority::Regular,
            'media'    => ProspectingMedia::Phone,
        ];

        if ($request->has('customer')) {
            $selected_data['customer'] = Customer::select('name', 'id', 'customer_id', 'ref_id')->find($request->customer);
            $ref_reporting             = json_decode($selected_data['customer']->reference->user_reporting);
            $select_data['freelancer'] = User::whereIn('id', $ref_reporting)->whereHas('freelancer', function ($q) {
                $q->where('designation_id', 20);
            })->first();
        }

        return view('prospecting.prospecting_save', compact('prospectingMedias', 'priorities', 'title', 'employees', 'selected_data'));
    }

    public function save(Request $request, $id = null) {
        $validator = Validator::make($request->all(), [
            'media'    => 'required',
            'priority' => 'required',
            'employee' => 'required',
            'remark'   => 'nullable|string|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator)->with('error', $validator->errors()->first());
        }

        if (!empty($id)) {
            $prospecting = Prospecting::find($id);
            $prospecting->update([
                'media'       => $request->media,
                'priority'    => $request->priority,
                'remark'      => $request->remark,
                'employee_id' => $request->employee,
                'updated_by'  => auth()->id(),
                'updated_at'  => now(),
            ]);
            return redirect()->route('prospecting.index')->with('success', 'Prospecting update successfully');

        } else {
            $prospecting              = new Prospecting();
            $prospecting->media       = $request->media;
            $prospecting->priority    = $request->priority;
            $prospecting->remark      = $request->remark;
            $prospecting->customer_id = $request->customer;
            $prospecting->employee_id = $request->employee;
            $prospecting->status      = 0;
            $prospecting->created_by  = auth()->id();
            $prospecting->created_at  = now();
            $approve_setting          = ApproveSetting::where('name', 'prospecting')->first();
            $is_admin                 = Auth::user()->hasPermission('admin');
            if ($approve_setting?->status == 0 || $is_admin) {
                $prospecting->approve_by = auth()->user()->id;
            } else {
                // Notification Create
                $prospecting->approve_by = null;
                $employee                = User::find($request->employee);
                if (!empty($employee) && count(json_decode($employee->user_reporting)) > 1) {
                    Notification::store([
                        'title'      => 'Prospecting approval request',
                        'content'    => auth()->user()->name . ' has created a Prospecting please approve as soon as possible',
                        'link'       => route('prospecting.approve'),
                        'created_by' => auth()->user()->id,
                        'user_id'    => [json_decode($employee->user_reporting)[1]],
                    ]);
                }
            }
            $prospecting->save();
            if ($prospecting) {
                $customer         = Customer::find($request->customer);
                $customer->status = 1;
                $customer->save();
            }
            return redirect()->route('prospecting.index')->with('success', 'Prospecting create successfully');
        }
    }

    public function edit(string $id) {
        $title             = 'Prospecting Edit';
        $prospecting       = Prospecting::find($id);
        $my_all_employee   = json_decode(Auth::user()->user_employee);
        $customers         = Customer::whereIn('ref_id', $my_all_employee)->get();
        $employees         = User::whereIn('id', $my_all_employee)->get();
        $prospectingMedias = $this->prospectingMedia();
        $priorities        = $this->priority();
        return view('prospecting.prospecting_save', compact('prospecting', 'customers', 'employees', 'prospectingMedias', 'priorities', 'title'));
    }

    public function prospectingDelete($id) {
        try {
            $data = Prospecting::find($id);
            $data->delete();
            return response()->json(['success' => 'Prospecting Deleted'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function prospecting_approve(ProspectingDataTable $dataTable, Request $request) {
        $title      = 'Prospecting List';
        $date       = $request->date ?? null;
        $status     = $request->status ?? 0;
        $start_date = Carbon::parse($date ? explode(' - ', $date)[0] : date('Y-m-01'))->format('Y-m-d');
        $end_date   = Carbon::parse($date ? explode(' - ', $date)[1] : date('Y-m-t'))->format('Y-m-d');

        $user_id      = Auth::user()->id;
        $my_employee  = my_employee($user_id);
        $prospectings = Prospecting::where('approve_by', null)->whereIn('employee_id', $my_employee)->orderBy('id', 'desc')->get();
        $prospectings = Prospecting::where('approve_by', null)->whereIn('employee_id', $my_employee)->orderBy('id', 'desc')->get();
        return view('prospecting.prospecting_approve', compact('prospectings'));
    }

    public function prospectingApprove(Request $request) {
        if ($request->has('prospecting_id') && $request->prospecting_id !== '' & $request->prospecting_id !== null) {
            DB::beginTransaction();
            try {
                foreach ($request->prospecting_id as $key => $prospecting_id) {
                    $prospecting             = Prospecting::where('id', $prospecting_id)->first();
                    $prospecting->approve_by = Auth::user()->id;
                    $prospecting->save();
                }
                DB::commit();
                return redirect()->route('prospecting.approve')->with('success', 'Status Updated Successfully');
            } catch (Exception $e) {
                DB::rollback();
                return redirect()->back()->withInput()->with('error', $e->getMessage());
            }

        } else {
            return redirect()->route('prospecting.approve')->with('error', 'Something went wrong!');
        }

    }

    public function select2_customer(Request $request) {
        $request->validate([
            'term' => ['nullable', 'string'],
        ]);

        $my_all_employee = json_decode(Auth::user()->user_employee);
        $users           = Customer::query()
            ->where(function ($query) use ($request) {
                $term = $request->term;
                $query->where('customer_id', 'like', "%{$term}%")
                    ->orWhere('name', 'like', "%{$term}%");
            })
            ->whereIn('ref_id', $my_all_employee)
            ->where('status', 0)
            ->whereNotNull('approve_by')
            ->select('id', 'name', 'customer_id')
            ->limit(10)
            ->get();

        $results = [
            ['id' => '', 'text' => 'Select Product'],
        ];
        foreach ($users as $user) {
            $results[] = [
                'id'   => $user->id,
                'text' => "{$user->name} ($user->customer_id)",
            ];

        }
        return response()->json([
            'results' => $results,
        ]);
    }
}
