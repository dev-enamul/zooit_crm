<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Division;
use App\Models\Village;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VillageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $divisions = Division::select('id', 'name')->get();
        $villages = Village::all();
        return view('village.village_list',compact('divisions','villages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('village.village_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
       try{
        Village::create([
            'name' => $request->village, 
            'union_id' => $request->union,
            'word_no'  => $request ->word_no, 
            'status'  => 1,
            'created_by' => Auth::user()->id, 
        ]);

        return redirect()->back()->with('success','Village Created');
       }catch(Exception $e){
            return redirect()->back()->with('error',$e); 
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
        try{
            Village::find($id)->delete();
            return redirect()->back()->with('success','Village Deleted');
        }catch(Exception $e){
            return redirect()->back()->with('error',$e);
        }
    }
}
