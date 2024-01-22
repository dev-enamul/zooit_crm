<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Division;
use App\Models\Union;
use App\Models\Upazila;
use Exception;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function divisionGetDistrict(Request $request)
    {
        try {
            $division = Division::find($request->id);
    
            if (!$division) {
                throw new Exception("Division not found");
            }
    
            $districts = District::where('division_id', $division->id)->get(['name', 'id']);
            return response()->json($districts);
        } catch (Exception $e) {
            return response()->json(["error" => $e->getMessage()], 404);
        }
    }

    public function districtGetUpazila(Request $request)
    {
        try {
            $district = District::find($request->id);
    
            if (!$district) {
                throw new Exception("District not found");
            }
    
            $upazilas = Upazila::where('district_id', $district->id)->get(['name', 'id']);
            return response()->json($upazilas);
        } catch (Exception $e) {
            return response()->json(["error" => $e->getMessage()], 404);
        }
    }

    public function upazilaGetUnion(Request $request)
    {
        try {
            $upazila = Upazila::find($request->id);
    
            if (!$upazila) {
                throw new Exception("Upazila not found");
            }
    
            $unions = Union::where('upazila_id', $upazila->id)->get(['name', 'id']);
            return response()->json($unions);
        } catch (Exception $e) {
            return response()->json(["error" => $e->getMessage()], 404);
        }
    }
}
