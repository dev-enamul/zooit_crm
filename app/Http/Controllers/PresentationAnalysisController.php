<?php

namespace App\Http\Controllers;

use App\DataTables\PresentationAnalysisDataTable;
use App\Enums\Priority;
use App\Models\ApproveSetting;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Freelancer;
use App\Models\LeadAnalysis;
use App\Models\Notification;
use App\Models\Presentation;
use App\Models\Profession;
use App\Models\Project;
use App\Models\Unit;
use App\Models\User;
use App\Models\VisitAnalysis;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PresentationAnalysisController extends Controller
{
    public function priority()
    {
        return Priority::values();
    }

    public function index(PresentationAnalysisDataTable $dataTable, Request $request)
    {
        $title = 'Presentation';
        $date = $request->date??null;
        $status = $request->status??0;
        $start_date = Carbon::parse($date ? explode(' - ',$date)[0] : date('Y-m-01'))->format('Y-m-d');
        $end_date = Carbon::parse($date ? explode(' - ',$date)[1] : date('Y-m-t'))->format('Y-m-d');
        $employee = $request->employee??null;
        $employee = $employee ? User::find($employee)?? User::find(auth()->user()->id) :  User::find(auth()->user()->id);
        return $dataTable->render('presentation_analysis.presentation_analysis_list', compact('title','employee','status','start_date','end_date'));
    }



    public function create(Request $request)
    {
        $title = 'Vist Analysis Entry';
        $user_id            = Auth::user()->id;

        $visitors           = User::where('status', 1)
                                ->with(['customer' => function ($query) {
                                    $query->select('id', 'customer_id')->first();
                                }])
                                ->select('name', 'id', 'user_id','user_type')
                                ->get();

        $priorities         = $this->priority();
        $projects           = Project::where('status',1)->select('id','name')->get();
        $units              = Unit::select('id','title')->get();

        $selected_data=[];
        if ($request->has('customer')) {
            $selected_data['customer'] = Customer::find($request->customer);
        }

        return view('presentation_analysis.presentation_analysis_save',compact('title','priorities','projects','units','visitors','selected_data'));
    }

    public function save(Request $request, $id = null)
    {
        $validator = Validator::make($request->all(), [
            'visitor'       => 'required|array',
            'visitor.*'     => 'string',
            'employee'      => 'required',
            'projects'      => 'required|array',
            'projects.*'    => 'string',
            'customer_id'   => 'required',
            'remark'        => 'nullable',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator)->with('error', $validator->errors()->first());
        }

        if (!empty($id)) {
            $visit = VisitAnalysis::findOrFail($id);
            $projectsJson = json_encode($request->input('projects'));
            $visit->visitors = json_encode($request->input('visitor'));
            $visit->employee_id = $request->employee;
            $visit->projects = $projectsJson;
            $visit->customer_id = $request->customer_id;
            $visit->remark = $request->remark;
            $visit->updated_by = $request->updated_by;
            $visit->updated_at = $request->updated_at;
            $visit->save();
            return redirect()->route('presentation_analysis.index')->with('success','Presemtation analysis update successfully');
        } else {
            $visit = new VisitAnalysis();
            $visit->visitors = json_encode($request->input('visitor'));;
            $visit->projects = json_encode($request->input('projects'));;
            $visit->customer_id = $request->customer_id;
            $visit->employee_id = $request->employee;
            $visit->remark = $request->remark;
            $approve_setting = ApproveSetting::where('name','visit_analysis')->first();
            $is_admin = Auth::user()->hasPermission('admin');
            if($approve_setting?->status == 0 || $is_admin){
                $visit->approve_by = auth()->user()->id;
            }else{
                $visit->approve_by = null;
                $employee = User::find($request->employee);
                if(!empty($employee) && count(json_decode($employee->user_reporting))>1) {
                    Notification::store([
                        'title' => 'Visit analysis approve request',
                        'content' => auth()->user()->name . ' has created a visit analysis please approve as soon as possible',
                        'link' => route('presentation-analysis.approve'),
                        'created_by' => auth()->user()->id,
                        'user_id' => [json_decode($employee->user_reporting)[1]]
                    ]);
                }
            }
            $visit->status = 0;
            $visit->created_at = now();
            $visit->created_by = auth()->id();
            $visit->save();

            if($visit) {
                $visit = Presentation::where('customer_id',$request->customer_id)->first();
                if(isset($visit) && $visit!=null){
                    $visit->status = 1;
                    $visit->save();
                }
            }

            return redirect()->route('presentation_analysis.index')->with('success','Presentation analysis create successfully');
        }
    }

    public function edit(string $id)
    {
        $title = 'Vist Analysis Edit';
        $my_all_employee    = json_decode(Auth::user()->user_employee);
        $customers          = Customer::whereIn('ref_id', $my_all_employee)->get();
        $freelancers        = User::where('user_type',2)->whereIn('ref_id',$my_all_employee)->get();
        $priorities         = $this->priority();
        $projects           = Project::where('status',1)->select('id','name')->get();
        $units              = Unit::select('id','title')->get();
        $visit              = VisitAnalysis::findOrFail($id);
        return view('presentation_analysis.presentation_analysis_save',compact('title','customers','priorities','projects','units','visit','freelancers'));
    }

    public function presentationDelete($id){
        try{
            $data  = Presentation::find($id);
            $data->delete();
            return response()->json(['success' => 'Presentation Analysis Deleted'],200);
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()],500);
        }
    }

    public function presentationAnalysisApprove(){
        $user_id        = Auth::user()->id;
        $my_employee    = my_employee($user_id);
        $presentations  = VisitAnalysis::where('approve_by', null)->whereIn('employee_id',$my_employee)->orderBy('id','desc')->get();
        return view('presentation_analysis.presentation_analysis_approve', compact('presentations'));
    }

    public function presentationAnalysisApproveSave(Request $request) {

        if($request->has('customer_id') && $request->customer_id !== '' & $request->customer_id !== null) {
            DB::beginTransaction();
            try {
                foreach ($request->customer_id as $key => $customer_id) {
                    $lead = VisitAnalysis::where('customer_id',$customer_id)->first();
                    $lead->approve_by = Auth::user()->id;
                    $lead->save();
                }
                DB::commit();
                return redirect()->route('presentation_analysis.index')->with('success', 'Status Updated Successfully');
            } catch (Exception $e) {
                DB::rollback();
                return redirect()->back()->withInput()->with('error', $e->getMessage());
            }

        } else {
            return redirect()->back()->with('error', 'Please Select Customer');
        }

    }

    public function presentation_analysis_details($id){
        try{
            $id = decrypt($id);
            $data = VisitAnalysis::find($id);
            $customer = Customer::find($data->customer_id);
            $user = User::find($customer->user_id);
            $employee = User::find($data->employee_id);
            $project = json_decode($data->projects);
            $visitors_id = json_decode($data->visitors);
            $visitors = User::whereIn('id',$visitors_id)->get();
            return view('presentation_analysis.presentation_analysis_details',compact([
                'data',
                'customer',
                'user',
                'employee',
                'project',
                'visitors'
            ]));

        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
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
            $users = Presentation::where('status',0)->where('approve_by','!=',null)
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

    public function get_visitor(Request $request){
        $request->validate([
            'term' => ['nullable', 'string'],
        ]);
        $my_all_employee = json_decode(Auth::user()->user_employee);
        $is_admin = Auth::user()->hasPermission('admin');
        $results = [
            ['id' => '', 'text' => 'Select Product']
        ];

        $employees = User::query()
            ->where(function ($query) use ($request) {
                $term = $request->term;
                $query->where('user_id', 'like', "%{$term}%")
                    ->orWhere('name', 'like', "%{$term}%");
            })
            ->orWhereHas('customer', function($q) use($request) {
                $term = $request->term;
                $q->where('customer_id', 'like', "%{$term}%");
            })
            ->limit(10)
            ->get();

            foreach ($employees as $user) {
                if($user->user_type==3){
                    $results[] = [
                        'id' => $user->id,
                        'text' => "{$user->customer->first()->name} [{$user->customer->first()->customer_id}]"
                    ];
                }else{
                    $results[] = [
                        'id' => $user->id,
                        'text' => "{$user->name} [{$user->user_id}]"
                    ];
                }

            }

        return response()->json([
            'results' => $results
        ]);
    }
}
