<?php

namespace App\Http\Controllers;

use App\Models\TrainingCategory;
use Illuminate\Http\Request;

class TrainingCategoryController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas  = TrainingCategory::where('status', 1)->latest()->get();
        return view('training.training_list',compact('datas'));
    }

   
    public function store(Request $request)
    { 
       $request->validate([
            'title' => 'required:max:45',
            'description' => 'nullable',
        ]);
       try{ 
 
            $input = $request->all(); 
            TrainingCategory::create($input);
            return redirect()->back()->with('success', 'Training Category created');
       }catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
       } 

    }
 
    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required:max:45',
            'description' => 'nullable',
        ]);
       try{
            $input = $request->all(); 
            TrainingCategory::find($request->id)->update($input);
            return redirect()->back()->with('success', 'Training Category updated');
       }catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
       }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    { 
        try{
            TrainingCategory::find($id)->delete();
            return response()->json(['success' => 'Training Category deleted']);
       }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()]);
       }
    }
}
