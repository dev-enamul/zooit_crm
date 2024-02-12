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
                        ->get(['id','name','project_id','unit_id','unit_category_id','status']);
        $projects       = Project::where('status',1)->select('id','name')->get();
        return view('product.unit',compact('projectUnits','projects'));
    }

    public function create()
    {
        $title      = "Project Unit Create";
        $products   = Project::select('id','name')->get();
        $units      = Unit::select('id','title')->get();
        $categories = UnitCategory::select('id','title')->get();

        return view('product.unit_save',compact('title','products','units','categories'));
    }

    public function save(Request $request, $id = null)
    {
        $validator = Validator::make($request->all(), [
            'project'           => 'required|exists:projects,id',
            'name'              => 'required|string|max:190',
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
                $info->name             = $request->name;
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
                            $unit_price = UnitPrice::where('project_unit_id', $info->id)
                                ->where('payment_duration', $request->payment_duration[$key])->first();

                            if ($unit_price) {
                                $unit_price->update([
                                    'lottery_price'     => $request->lottery_price[$key],
                                    'on_choice_price'   => $request->on_choice_price[$key],
                                    'status'            => 1,
                                    'updated_at'        => now(),
                                ]);
                            } else {
                                UnitPrice::create([
                                    'project_unit_id'   => $info->id,
                                    'payment_duration'  => $request->payment_duration[$key],
                                    'lottery_price'     => $request->lottery_price[$key],
                                    'on_choice_price'   => $request->on_choice_price[$key],
                                    'status'            => 1,
                                    'updated_at'        => now(),
                                ]);
                            }
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

    public function edit($id){
        $title          = "Project Unit Edit";
        $units          = Unit::select('id','title')->get();
        $products       = Project::select('id','name')->get();
        $categories     = UnitCategory::select('id','title')->get();
        $project_unit   = ProjectUnit::with('unitPrices')->findOrFail($id);
        return view('product.unit_save',compact('title','units','products','categories','project_unit'));
    }

    public function productUnitDelete($id){
        try{ 
            $data  = ProjectUnit::find($id);
            UnitPrice::where('project_unit_id', $id)->delete();
            $data->delete();
            return response()->json(['success' => 'Project Unit Deleted'],200);
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()],500);
        }
    }

    public function productUnitSearch(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status'         => 'nullable',
            'project'        => 'nullable',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errorMessage = implode('<br>', $errors);
        
            if ($validator->fails()) {
                return redirect()->back()->withInput()->withErrors($validator)->with('error', 'Validation failed.');
            }
        }

        try{
            $requestData = $request->except('token');

            if (count($requestData) === 0) {
                return redirect()->route('unit.index')->with('error', 'Please select project and status!');
            }
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $status         = $request->status;
                $project_id     = $request->project;

                $selected['status']      = $status;
                $selected['project_id'] = $project_id;

                $projectUnits = ProjectUnit::query();

                if ($request->has('status') && $request->status != null) {
                    $projectUnits->where('status', $request->status);
                }

                if ($request->has('project') && $request->project != null) {
                    $projectUnits->where('project_id', $request->project);
                }

                $projectUnits->with(['project:id,name', 'unit:id,title,down_payment', 'unitCategory:id,title']);

                $projectUnits = $projectUnits->get(['id', 'name', 'project_id', 'unit_id', 'unit_category_id', 'status']);

                $projects = Project::where('status',1)->select('id','name')->get();
                
                return view('product.unit', compact('projects','selected','projectUnits'));
            }
        }
        catch (\Throwable $th) {
            dd( $th);
            return redirect()->route('product.edit')->with('error', 'Something went wrong!');
         }
    }
}
