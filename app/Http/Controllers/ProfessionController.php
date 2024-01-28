<?php

namespace App\Http\Controllers;

use App\Models\Profession;
use Exception;
use Illuminate\Http\Request;

class ProfessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Profession::where('status',1)->get();
        return view('profession.profession_list',compact('datas'));
    }

    
    public function store(Request $request)
    {
      try{
        $input = $request->all();
        Profession::create($input);
        return redirect()->back()->with('success','Profession Created');
      }catch(Exception $e){
        return redirect()->back()->with('error',$e->getMessage());
      }
    }

  
     
    public function update(Request $request)
    {
        try{
          $data = Profession::find($request->id);
          $data->name = $request->name;
          $data->save();
          return redirect()->back()->with('success','Profession Updated');
        }catch(Exception $e){
          return redirect()->back()->with('error',$e->getMessage());
        }
    }
 
    public function destroy(string $id)
    {
       try{
            $data = Profession::find($id);
            $data->delete();
            return redirect()->back()->with('success','Profession Deleted');
       }catch(Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
       }
    }
}
