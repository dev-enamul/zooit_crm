<?php

namespace App\Http\Controllers;

use App\Models\Freelancer;
use App\Models\FreelancerApprovel;
use App\Models\TrainingCategory;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApproveFreelancerController extends Controller
{
    
    public function index()
    {
        $trainings = TrainingCategory::where('status', '1')->get(); 
        $datas = User::where('user_type', '2')->where('approve_by',null)->whereHas('freelancer', function($query){
            $my_employee = my_employee(auth()->user()->id);
         
            $query->whereIn('last_approve_by',$my_employee);
        })->get();
        return view('freelancer.approve-freelancer',compact('datas','trainings'));
    }

  
    public function store(Request $request)
    {
        DB::beginTransaction();
        try{
            $freelancer = Freelancer::where('user_id',$request->freelancer_id)->first(); 
            $freelancer->last_approve_by = auth()->user()->id;
            $freelancer->save(); 

            $input = $request->all();
            $input['approve_by'] = auth()->user()->id;
            if($request->meeting_date && $request->meeting_time){
                $input['meeting_date'] = $request->meeting_date . ' ' . $request->meeting_time;
            }
            
            FreelancerApprovel::create($input);  
            if(isset($request->user_id)){
                $user = User::find($request->user_id);
                $user->approve_by = auth()->user()->id;
                $user->save();
            } 
            
            DB::commit(); 
            return redirect()->back()->with('success', 'Freelancer approved successfully');
        }catch(Exception $e){
            DB::rollBack();
            dd($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
