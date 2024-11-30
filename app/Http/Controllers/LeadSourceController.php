<?php

namespace App\Http\Controllers;

use App\Models\FindMedia;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LeadSourceController extends Controller
{
    public function index()
    {
         $datas = FindMedia::get();
         return view('lead_source.lead_source',compact('datas'));
    }
  
    public function store(Request $request)
    {
        try{
            $input = $request->all();
            $input['slug'] = Str::slug($request->service);
            FindMedia::create($input);
            return redirect()->back()->with('success','Service Created');
          }catch(Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
          }
    }
  
    public function update(Request $request, string $id)
    {
        try{
            $data = FindMedia::find($request->id);
            $data->name = $request->name;
            $data->save();
            return redirect()->back()->with('success','Service Updated');
          }catch(Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
          }
    }
 
    public function destroy(string $id)
    {
        try{
            $data = FindMedia::find($id);
            $data->delete();
            return response()->json(['success' => 'Service deleted successfully']);
       }catch(Exception $e){
        return response()->json(['error' => $e->getMessage()]);
       }
    }
}
