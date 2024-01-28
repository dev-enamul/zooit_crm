<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Zone;
use Exception;
use Illuminate\Http\Request;

class ZoneAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $zone_id = $request->zone;
        $zones = Zone::where('status',1)->get();
        $datas = Area::where('status',1); 
        if(isset($zone_id)){
            $datas = $datas->where('zone_id', $zone_id);
        }
        $datas = $datas->get();

        return view('location.area',compact('datas','zones','zone_id'));
    }

    
    public function store(Request $request)
    {
       try{
        $data = new Area();
        $data->zone_id = $request->zone_id;
        $data->name = $request->name;
        $data->save();
        return redirect()->back()->with('success','Area Created');
       }catch(Exception $e){
        return redirect()->back()->with('error',$e->getMessage());
       }
    }

 
    public function update(Request $request)
    {
        try{
            $data =  Area::find($request->id);
            $data->zone_id = $request->zone_id;
            $data->name = $request->name;
            $data->save();
            return redirect()->back()->with('success','Area Updated');
           }catch(Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
           }
    } 
    public function destroy(string $id)
    {
        try{
            $data =  Area::find($id);
            $data->delete(); 
            return redirect()->back()->with('success','Area Updated');
           }catch(Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
           }
    }
}
