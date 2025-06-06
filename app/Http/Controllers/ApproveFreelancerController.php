<?php

namespace App\Http\Controllers;

use App\DataTables\ApproveFreelanerDataTable;
use App\Models\Freelancer;
use App\Models\FreelancerApprovel;
use App\Models\Notification;
use App\Models\TrainingCategory;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApproveFreelancerController extends Controller {

    public function index(ApproveFreelanerDataTable $dataTable, Request $request){
      
        $title = 'Freelancer Approve List';
        $date = $request->date??null;
        $status = $request->status??0;
        $start_date = Carbon::parse($date ? explode(' - ',$date)[0] : date('Y-m-01'))->format('Y-m-d');
        $end_date = Carbon::parse($date ? explode(' - ',$date)[1] : date('Y-m-t'))->format('Y-m-d');
        $employee = $request->employee??null;  
        $employee = $employee ? User::find($employee)?? User::find(auth()->user()->id) :  User::find(auth()->user()->id);
        $trainings   = TrainingCategory::where('status', '1')->get(); 
        $next_freelancer_id = User::generateNextFreelancerId();
        return $dataTable->render('freelancer.approve-freelancer',compact('trainings','next_freelancer_id','title','status','employee','start_date','end_date'));
    }
  

    public function store(Request $request) {
        DB::beginTransaction();
        try {
            $freelancer                  = Freelancer::where('user_id', $request->user_id)->first();
            $freelancer->last_approve_by = auth()->user()->id;
            $freelancer->save();

            $input                  = $request->all();
            $input['approve_by']    = auth()->user()->id;
            $input['freelancer_id'] = $request->user_id;
            if ($request->meeting_date && $request->meeting_time) {
                $input['meeting_date'] = $request->meeting_date . ' ' . $request->meeting_time;
            }

            FreelancerApprovel::create($input);
            $hasIdPermission = Auth::user()->hasPermission('freelancer-id-create');

            if ($hasIdPermission) {
                if (isset($request->fl_id) && $request->fl_id != null) {
                    $freelancer->status = 1;
                    $freelancer->save();
                    $freelancer->user->user_id = $request->fl_id;
                    $freelancer->user->save();
                }
            }

            $auth_user = Auth::user();
            if (count(json_decode($auth_user->user_reporting)) > 1) {
                Notification::store([
                    'title'      => 'Freelancer approval request',
                    'content'    => $auth_user->name . ' has created a freelancer approve please approve as soon as possible',
                    'link'       => url('approve-freelancer'),
                    'created_by' => auth()->user()->id,
                    'user_id'    => [json_decode($auth_user->user_reporting)[1]],
                ]);
            }

            DB::commit();
            return redirect()->back()->with('success', 'Freelancer approved successfully');
        } catch (Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function complete_training($id) {
        $id = decrypt($id);
        DB::beginTransaction();
        try {
            $user             = User::find($id);
            $user->status     = 1;
            $user->approve_by = auth()->user()->id;
            $user->save();

            FreelancerApprovel::create([
                'freelancer_id'     => $id,
                'counselling'       => 0,
                'interview'         => 0,
                'remarks'           => 'Congratulations! You have completed all training. Now, you can work as a freelancer.',
                'approve_by'        => auth()->user()->id,
                'complete_training' => 1,
            ]);
            $user->freelancer->status          = 1;
            $user->freelancer->last_approve_by = auth()->user()->id;
            $user->freelancer->save();
            DB::commit();
            return response()->json(['success' => 'Training Completed Successfully'], 200);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}
