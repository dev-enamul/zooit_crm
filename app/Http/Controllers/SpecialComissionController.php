<?php

namespace App\Http\Controllers;

use App\Models\Commission;
use App\Models\CommissionSpecialCommission;
use App\Models\SpecialCommission;
use Exception;
use Illuminate\Http\Request;

class SpecialComissionController extends Controller
{ 
    public function index()
    {
        $datas = SpecialCommission::where('status', 1)->latest()->get();
        return view('special_comission.special_comission_list', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    { 
        $commissions = Commission::where('status', 1)->latest()->get();
        return view('special_comission.special_comission_create', compact('commissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $input = $request->all();
            $input['start_date'] = date('Y-m-d', strtotime($request->start_date));
            $input['end_date'] = date('Y-m-d', strtotime($request->end_date));
            $input['created_by'] = auth()->user()->id; 
            $special_commission = SpecialCommission::create($input);

            if(is_array($request->commission_id) && count($request->commission_id)>0){
                foreach($request->commission_id as $key => $commission_id){
                    $commission = CommissionSpecialCommission::create([
                        'commissions_id' => $commission_id,
                        'commission' => $request->commission[$key],
                        'special_commissions_id' => $special_commission->id,
                        'created_by' => auth()->user()->id
                    ]);
                }
            } 
            return redirect()->route('special-commission.index')->with('success', 'Special Commission created');
        }catch(Exception $e){  
            return redirect()->back()->with('error', $e->getMessage()); 
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try{
            $data = SpecialCommission::find($id); 
            if(!$data){
                return redirect()->back()->with('error', 'Data not found');
            }
            return view('special_comission.special_comission_details',compact('data'));
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }   
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data  = SpecialCommission::find($id);
        if(!$data){
            return redirect()->back()->with('error', 'Data not found');
        }
        return view('special_comission.special_comission_edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    { 
        try{
            $input = $request->all();
            $input['start_date'] = date('Y-m-d', strtotime($request->start_date));
            $input['end_date'] = date('Y-m-d', strtotime($request->end_date));
            $input['created_by'] = auth()->user()->id; 

            $special_commission = SpecialCommission::find($id);  
            if ($special_commission) {
                $special_commission = $special_commission->update($input);
            }else{
                return redirect()->back()->with('error', 'Data not found');
            }

            if(is_array($request->commission_id) && count($request->commission_id)>0){
                foreach($request->commission_id as $key => $commission_id){
                    $commission = CommissionSpecialCommission::find($commission_id);
                    if($commission){
                        $commission->update([
                            'commission' => $request->commission[$key],
                            'updated_by' => auth()->user()->id
                        ]); 
                    }
                }
            } 
            return redirect()->route('special-commission.index')->with('success', 'Special Commission created');
        }catch(Exception $e){  
            return redirect()->back()->with('error', $e->getMessage()); 
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $special_commission = SpecialCommission::find($id); 
            if(!$special_commission){
                return response()->json(['error' => 'Data not found']);
            } 
            $special_commission->delete();
            return response()->json(['success' => 'Special Commission deleted']);
       }catch(\Exception $e){ 
            return response()->json(['error' => $e->getMessage()]);
       }
    }
}
