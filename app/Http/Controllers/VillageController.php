<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\District;
use App\Models\Division;
use App\Models\Union;
use App\Models\Upazila;
use App\Models\Village;
use App\Traits\AreaTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class VillageController extends Controller
{

    use AreaTrait;
    
   
    public function index(Request $request)
    {
        $divisions = Division::select('id', 'name')->get();
        $districts = District::select('id', 'name')->get();
        $upazilas = Upazila::select('id', 'name')->get();
        $unions = Union::select('id', 'name')->get();
       

        $division =  $request->division;
        $district = $request->district;
        $upazila = $request->upazila;
        $union = $request->union; 
        $villages = Village::where('status',1);
        if(isset($union)){
            $villages =  $villages->where('union_id',$union);
        }

        if(isset($upazila)){
            $villages =  $villages->whereHas('union',function($q) use ($upazila){
                $q->where('upazila_id',$upazila);
            });
        }

        if(isset($district)){
            $villages =  $villages->whereHas('union',function($q) use ($district){
                 $q->whereHas('upazilla',function($p)use($district){
                    $p->where('district_id', $district); 
                 });
            });
        } 

        if(isset($division)){
            $villages =  $villages->whereHas('union',function($q) use ($division){
                 $q->whereHas('upazilla',function($p)use($division){
                     $p->whereHas('district',function($x) use ($division){
                        $x->where('division_id',$division);
                     });
                 });
            });
        }  

        $villages = $villages->paginate(2); 
        return view('location.village_list',compact('divisions','villages','districts','upazilas','unions'));
    }

   
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
 
    public function update(Request $request)
    {
        try{
           $data =  Village::find($request->id);
           $data->word_no = $request->word_no;
           $data->village  = $request->village;
           $data->save();
           return redirect()->back()->with('success','Village Updated');
        }catch(Exception $e){
            return redirect()->back()->with('error',$e);
        }
    }
 
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
