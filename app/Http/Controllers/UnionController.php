<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Union;
use Exception;
use Illuminate\Http\Request;

class UnionController extends Controller
{
    
    public function index()
    { 
        $datas = Union::paginate(20);
        $divisions = Division::select('id', 'name')->get();
        return view('location.union_list',compact('datas','divisions'));
    }

   
    public function create()
    {
        return view('location.union_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = new Union();
        $data->upazila_id = $request->upazila;
        $data->name = $request->union;
        $data->bn_name = $request->union;
        $data->url = $request->union;
        $data->save();
        return redirect()->back()->with('success',"Union Created");
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
            $data = Union::find($id);
            $data->delete();
            return response()->json(['success' => 'Training Completed Successfully'], 200);
       }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()], 200);
       }
    }
}
