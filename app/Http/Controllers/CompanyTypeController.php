<?php

namespace App\Http\Controllers;

use App\Models\CompanyType;
use Exception;
use Illuminate\Http\Request;

class CompanyTypeController extends Controller
{
    public function index()
    {
        $datas = CompanyType::where('status',1)->get();
        return view('company_type.company_type_list',compact('datas'));
    }

    
    public function store(Request $request)
    {
      try{
        $input = $request->all();
        CompanyType::create($input);
        return redirect()->back()->with('success','Profession Created');
      }catch(Exception $e){
        return redirect()->back()->with('error',$e->getMessage());
      }
    }

  
     
    public function update(Request $request)
    {
        try{
          $data = CompanyType::find($request->id);
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
            $data = CompanyType::find($id);
            $data->delete();
            return redirect()->back()->with('success','Profession Deleted');
       }catch(Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
       }
    }
}
