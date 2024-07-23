<?php

namespace App\Http\Controllers;

use App\DataTables\PresentationDataTable;
use App\Enums\Priority;
use App\Models\ApproveSetting;
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

class PresentationController extends Controller {
    public function priority() {
        return Priority::values();
    } 
    public function index(PresentationDataTable $dataTable, Request $request) {
        $title      = 'Presentation';
        $date       = $request->date ?? null;
        $status     = $request->status ?? 0;
        $start_date = Carbon::parse($date ? explode(' - ', $date)[0] : date('Y-m-01'))->format('Y-m-d');
        $end_date   = Carbon::parse($date ? explode(' - ', $date)[1] : date('Y-m-t'))->format('Y-m-d');
        $employee   = $request->employee ?? null;
        $employee   = $employee ? User::find($employee) ?? User::find(auth()->user()->id) : User::find(auth()->user()->id);
        return $dataTable->render('presentation.presentation_list', compact('title', 'employee', 'status', 'start_date', 'end_date'));
    }

    public function create(Request $request) {
        $title                     = 'Presentation Entry'; 
        $priorities                = $this->priority(); 
        $selected_data['priority'] = Priority::Regular;
        if ($request->has('customer')) {
            $selected_data['customer'] = Customer::find($request->customer);
        }
        return view('presentation.presentation_save', compact('title', 'priorities', 'selected_data'));
    }

    public function customer_data(Request $request) {
        $lead_analysis = LeadAnalysis::where('customer_id', $request->customer_id)->first();
        return response()->json($lead_analysis, 200);
    }

    public function save(Request $request, $id = null) {
        $validator = Validator::make($request->all(), [
            'customer'      => 'required', 
            'priority'      => 'required',
            'followup_date' => 'required',
            'remark'        => 'nullable|string|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator)->with('error', $validator->errors()->first());
        }

        if (!empty($id)) {
            $presentation = Presentation::find($id);
            $presentation->update([
                'customer_id'   => $request->customer,
                'employee_id'   => auth()->id(),
                'followup_date' => $request->followup_date,
                'priority'      => $request->priority,
                'remark'        => $request->remark, 
                'updated_by'    => auth()->id(),
                'updated_at'    => now(),
            ]);
            return redirect()->route('presentation.index')->with('success', 'Presemtation update successfully');

        } else {
            $presentation              = new Presentation();
            $presentation->priority    = $request->priority;
            $presentation->remark      = $request->remark;
            $presentation->customer_id = $request->customer;
            $presentation->followup_date = $request->followup_date;
            $presentation->employee_id = Auth::user()->id; 
            $approve_setting           = ApproveSetting::where('name', 'presentation')->first();
            $is_admin                  = Auth::user()->hasPermission('admin');
            if ($approve_setting?->status == 0 || $is_admin) {
                $presentation->approve_by = auth()->user()->id;
            } else {
                $presentation->approve_by = null;
                $employee                 = User::find($request->employee);
                if (!empty($employee) && count(json_decode($employee->user_reporting)) > 1) {
                    Notification::store([
                        'title'      => 'Presentation approval request',
                        'content'    => auth()->user()->name . ' has created a Presentation please approve as soon as possible',
                        'link'       => route('presentation.approve'),
                        'created_by' => auth()->user()->id,
                        'user_id'    => [json_decode($employee->user_reporting)[1]],
                    ]);
                }
            }
            $presentation->status     = 0;
            $presentation->created_by = auth()->id();
            $presentation->created_at = now();
            $presentation->save();

            if ($presentation) {
                Lead::where('customer_id', $request->customer)->update(['status' => 1]); 
            }
            return redirect()->route('presentation.index')->with('success', 'Presentation create successfully');
        }
    }

    public function edit(string $id) {
        $title           = 'Presentation Edit';  
        $priorities      = $this->priority(); 
        $presentation    = Presentation::find($id); 
        $selected_data['customer'] = $presentation->customer;
        return view('presentation.presentation_save', compact('selected_data','title','priorities', 'presentation'));
    }

    public function presentationDelete($id) {
        try {
            $data = Presentation::find($id);
            $data->delete();
            return response()->json(['success' => 'Presentation Deleted'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function presentationApprove() {
        $user_id     = Auth::user()->id;
        $my_employee = my_employee($user_id);
        $presentations  = Presentation::where('approve_by', null)->whereIn('employee_id',$my_employee)->orderBy('id','desc')->get();
        return view('presentation.presentation_approve', compact('presentations'));
    }

    public function presentationApproveSave(Request $request) {
        if ($request->has('presentation_id') && $request->presentation_id !== '' && $request->presentation_id !== null) {
            DB::beginTransaction();
            try {
                foreach ($request->presentation_id as $key => $presentation_id) {
                   Presentation::where('id', $presentation_id)->update(['approve_by' => Auth::user()->id]); 
                }
                DB::commit();
                return redirect()->route('presentation.approve')->with('success', 'Status Updated Successfully');
            } catch (Exception $e) {
                DB::rollback();
                return redirect()->back()->withInput()->with('error', $e->getMessage());
            }

        } else {
            return redirect()->route('presentation.approve')->with('error', 'Something went wrong!');
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
