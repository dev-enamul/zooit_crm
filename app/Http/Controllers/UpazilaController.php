<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Upazila;
use Exception;
use Illuminate\Http\Request;

class UpazilaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Upazila::paginate(20);
        $divisions = Division::select('id', 'name')->get();
        return view('location.upazila_list',compact('datas','divisions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = new Upazila();
        $data->name = $request->upazila;
        $data->bn_name =  $request->upazila;
        $data->url = $request->upazila;
        $data->district_id = $request->district;
        $data->save();
        return redirect()->back()->with('success','Upazila Created');
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
            $data = Upazila::find($id);
            $data->delete();
            return response()->json(['success' => 'Training Completed Successfully'], 200);
       }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()], 200);
       }
    }
}
