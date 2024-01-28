<?php

namespace App\Http\Controllers;

use App\Models\Zone;
use Exception;
use Illuminate\Http\Request;

class ZoneController extends Controller
{ 
    public function index()
    {
        $datas = Zone::where('status',1)->get();
        return view('location.zone',compact('datas'));
    }
  
    public function store(Request $request)
    {
       try{
            $data  = new Zone();
            $data->name = $request->name;
            $data->save();
            return redirect()->back()->with('success','Zone Created');
       }catch(Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
       }
    }

   
    public function update(Request $request)
    {
        try{
            $data = Zone::find($request->id);
            $data->name = $request->name;
            $data->save();
            return redirect()->back()->with('success','Zone Updated');
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
            $data = Zone::find($id);
            $data->delete();
            return redirect()->back()->with('success','Zone Deleted');
        }catch(Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }
    }
}
