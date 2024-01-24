<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectUnit;
use App\Models\Unit;
use App\Models\UnitCategory;
use App\Models\UnitPrice;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Project::select('id','name')->get();
        return view('product.unit',compact('products'));
    }

    public function create()
    {
        $title      = "Unit Create";
        $products   = Project::select('id','name')->get();
        $units      = Unit::select('id','title')->get();
        $categories = UnitCategory::select('id','title')->get();

        return view('product.unit_save',compact('title','products','units','categories'));
    }

    public function save(Request $request, $id = null)
    {
        dd($request->all()); 

        $validator = Validator::make($request->all(), [
            'project'           => 'required|exists:projects,id',
            'name'              => 'required|string|max:190',
            'floor'             => 'required|numeric',
            'unit'              => 'required|exists:units,id',
            'category'          => 'required|exists:unit_categories,id',
            'description'       => 'nullable|string|max:5000',
            'lottery_price'     => 'required|numeric',
            'on_choice_price'   => 'required|numeric',
            'payment_duration'  => 'required|numeric',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator)->with('error', 'Validation failed.');
        }

        $user_id = Auth::user()->id;

        if (!empty($id)) {

            $info = ProjectUnit::find($id);

            if (!empty($info)){
                $info->name             = $request->project;
                $info->floor            = $request->total_floor;
                $info->project_id       = $request->project;
                $info->unit_category_id = $request->category;
                $info->unit_id          = $request->unit;
                $info->description      = $request->description;
                $info->status           = 1;
                $info->updated_by       = $user_id;
                DB::beginTransaction();
                try {
                    $info->save();

                    if ($info) {
                        $unit_price = UnitPrice::find($info->id);
                        $unit_price->project_unit_id    = $info->id;
                        $unit_price->payment_duration   = $request->payment_duration;
                        $unit_price->lottery_price      = $request->lottery_price;
                        $unit_price->on_choice_price    = $request->on_choice_price;
                        $unit_price->status             = 1;
                        $unit_price->updated_at         = now();
                        $unit_price->save();
                    }
                    DB::commit();
                    return redirect()->route('product.index')->with('success', 'Project updated successfully');
                } catch (Exception $e) {
                    DB::rollback();
                    return redirect()->back()->withInput()->with('error', $e->getMessage());
                }
            }
            else{
                return  redirect()->back('error', 'Project not found');
            }
        }

        $data = [
            'name'              => $request->name,
            'floor'             => $request->total_floor,
            'project_id'        => $request->google_map,
            'unit_category_id'  => $request->address,
            'unit_id'           => $request->description,
            'description'       => $request->country,
            'status'            => 1,
            'created_by'        => $user_id,
        ];

        DB::beginTransaction();
        try {
            $project_unit = ProjectUnit::create($data);

            $unit_price = UnitPrice::find($project_unit->id);
                $unit_price->project_unit_id    = $project_unit->id;
                $unit_price->payment_duration   = $request->payment_duration;
                $unit_price->lottery_price      = $request->lottery_price;
                $unit_price->on_choice_price    = $request->on_choice_price;
                $unit_price->status             = 1;
                $unit_price->updated_at         = now();
                $unit_price->save();
            DB::commit();
            
            return redirect()->route('unit.index')->with('success', 'Project created successfully');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with('error', $e->getMessage());
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
        //
    }
}
