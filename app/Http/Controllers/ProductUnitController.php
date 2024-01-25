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
        $projectUnits = ProjectUnit::where('status', 1)
                        ->with(['project:id,name','unit:id,title,down_payment','unitCategory:id,title'])
                        ->get(['id','name','project_id','unit_id','unit_category_id']);        
        return view('product.unit',compact('projectUnits'));
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
        $validator = Validator::make($request->all(), [
            'project'           => 'required|exists:projects,id',
            'name'              => 'required|numeric|max:190',
            'floor'             => 'required|numeric',
            'unit'              => 'required|exists:units,id',
            'category'          => 'required|exists:unit_categories,id',
            'description'       => 'nullable|string|max:5000',
            'lottery_price.*'   => 'required|numeric',
            'on_choice_price.*' => 'required|numeric',
            'payment_duration.*'=> 'required|numeric',
        ]);
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user_id = Auth::user()->id;

        if (!empty($id)) {
            $info = ProjectUnit::find($id);

            if (!empty($info)){
                $info->name             = $request->project;
                $info->floor            = $request->floor;
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
                        foreach ($request->payment_duration as $key => $value) {
                            $unit_price = new UnitPrice();
                            $unit_price->project_unit_id = $info->id;
                            $unit_price->payment_duration = $request->payment_duration[$key];
                            $unit_price->lottery_price = $request->lottery_price[$key];
                            $unit_price->on_choice_price = $request->on_choice_price[$key];
                            $unit_price->status = 1;
                            $unit_price->updated_at = now();
                            $unit_price->save();
                        }
                    }
                    DB::commit();
                    return response()->json(['success' => 'Unit updated successfully']);
                } catch (Exception $e) {
                    DB::rollback();
                    return response()->json(['error' => $e->getMessage()], 422);
                }
            }
            else{
                return response()->json(['error' => 'Unit not found'], 422);
            }
        }

        $data = [
            'name'              => $request->name,
            'floor'             => $request->floor,
            'project_id'        => $request->project,
            'unit_category_id'  => $request->category,
            'unit_id'           => $request->unit,
            'description'       => $request->description,
            'status'            => 1,
            'created_by'        => $user_id,
        ];

        DB::beginTransaction();
        try {
            $project_unit = ProjectUnit::create($data);

            foreach ($request->payment_duration as $key => $value) {
                $unit_price = new UnitPrice();
                $unit_price->project_unit_id = $project_unit->id;
                $unit_price->payment_duration = $request->payment_duration[$key];
                $unit_price->lottery_price = $request->lottery_price[$key];
                $unit_price->on_choice_price = $request->on_choice_price[$key];
                $unit_price->updated_at = now();
                $unit_price->save();
            }
            DB::commit();
            return response()->json(['success' => 'Unit created successfully']);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['error' => $e->getMessage()], 422);
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
