<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Division;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\Village;
use App\Traits\ImageUploadTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    use ImageUploadTrait;

    public function index(){
        return view('product.product_list');
    }

    public function create(){
        $divisions = Division::select('id', 'name')->get();
        $countries = Country::select('id','name')->get();
        $villages  = Village::pluck('name');
        return view('product.product_create', compact('divisions', 'countries', 'villages'));
    }

    public function save(Request $request, $id = null)
    {
        
        $validator = Validator::make($request->all(), [
            'name'          => 'required|max:190',
            'country'       => 'required|exists:countries,id',
            'division'      => 'required|exists:divisions,id',
            'district'      => 'required|exists:districts,id',
            'upazila'       => 'required|exists:upazilas,id',
            'union'         => 'required|exists:unions,id',
            'village'       => 'required',  // Change this as needed
            'total_floor'   => 'nullable|numeric|min:1',
            'google_map'    => 'nullable|string',
            'address'       => 'nullable|string|max:5000',
            'description'   => 'nullable|string|max:5000',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3072',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    

        $user_id = Auth::user()->id;

        if (!empty($id)) {
            dd($request->all());

            $info = Project::find($id);

            if (!empty($info)){
                $info->name             = $request->name;
                $info->total_floor      = $request->total_floor;
                $info->google_map       = $request->google_map;
                $info->address          = $request->address;
                $info->description      = $request->description;
                $info->country_id       = $request->country;
                $info->division_id      = $request->division;
                $info->district_id      = $request->district;
                $info->upazila_id       = $request->upazila;
                $info->union_id         = $request->union;
                $info->village_id       = 1;  #have_to_change 
                $info->status           = 1;
                $info->updated_by       = $user_id;
                DB::beginTransaction();
                try {
                    $info->save();

                    if ($request->hasFile('image')) {
                        $p_images = new ProjectImage();
                        $p_images->project_id = $info->id;
                        $p_images->name =   $this->uploadImage($request, 'image', 'projects', 'public'); 
                        $p_images->save();
                    }
                    DB::commit();
                    return redirect()->route('product.index');
                } catch (Exception $e) {
                    DB::rollback();
                    return $e;
                }
            }
            else{
                return  "No record found";
            }
        }

        $data = [
            'name'          => $request->name,
            'total_floor'   => $request->total_floor,
            'google_map'    => $request->google_map,
            'address'       => $request->address,
            'description'   => $request->description,
            'country_id'    => $request->country,
            'division_id'   => $request->division,
            'district_id'   => $request->district,
            'upazila_id'    => $request->upazila,
            'union_id'      => $request->union,
            'village_id'    => 1,  #have_to_change     
            'status'        => 1,
            'created_by'    => $user_id,
        ];

        DB::beginTransaction();
        try {
            $project = Project::create($data);
             if ($request->hasFile('image')) {
                        $p_images = new ProjectImage();
                        $p_images->project_id = $project->id;
                        $p_images->name =   $this->uploadImage($request, 'image', 'projects', 'public'); 
                        $p_images->save();
                    }
            DB::commit();
            return redirect()->route('product.index');
        } catch (Exception $e) {
            DB::rollback();
            return $e;
        }
    }

    public function sold_unsold(){
        return view('product.sold_unsold');
    }

    public function product_approve(){
        return view('product.product_approve');
    }
}
