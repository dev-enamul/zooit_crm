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
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    use ImageUploadTrait;

    public function index(){
        $projects = Project::where('status',1)->select('id','name','address','total_floor')->get();
        return view('product.product_list',compact('projects'));
    }

    public function create(){
        $title     = "Product Create";
        $divisions = Division::select('id', 'name')->get();
        $countries = Country::select('id','name')->get();
        $villages  = Village::select('id','name')->get();
        return view('product.product_save', compact('divisions', 'countries', 'villages', 'title'));
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
            'village'       => 'required|exists:villages,id',  
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
                $info->village_id       = $request->village; 
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
            'village_id'    => $request->village,   
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
            
            return redirect()->route('product.index')->with('success', 'Project created successfully');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function edit($id){
        $title     = "Product Edit";
        $divisions = Division::select('id', 'name')->get();
        $countries = Country::select('id','name')->get();
        $villages  = Village::select('id','name')->get();
        $product   = Project::find($id);
        return view('product.product_save', compact('divisions', 'countries', 'villages', 'title', 'product'));
    }




    public function sold_unsold(){
        return view('product.sold_unsold');
    }
}
