<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Unit;
use App\Models\Project;
use App\Traits\AreaTrait;
use App\Models\ProjectImage;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    use ImageUploadTrait;
    use AreaTrait;

    public function index(){
        $divisions      = $this->getCachedDivisions();
        $projects       = Project::where('status',1)->with('units')->select('id','name','address','total_floor')->get();
        $unit_headers   = Unit::where('status',1)->select('id','title')->get();
        
        return view('product.product_list',compact('projects','divisions','unit_headers'));
    }

    public function create(){
        $title     = "Product Create";
        $divisions = $this->getCachedDivisions();
        $districts = $this->getCachedDistricts();
        $upazilas  = $this->getCachedUpazilas();
        $unions    = $this->getCachedUnions();
        $villages  = $this->getCachedVillages();
        return view('product.product_save', compact('title','divisions','districts','upazilas','unions','villages'));
    }

    public function save(Request $request, $id = null)
    { 
        $validator = Validator::make($request->all(), [
            'name'          => 'required|string|max:190',
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
            return redirect()->back()->withInput()->withErrors($validator)->with('error', 'Validation failed.');
        }

        $user_id = Auth::user()->id;

        if (!empty($id)) {

            $info = Project::find($id);

            if (!empty($info)){
                $info->name             = $request->name;
                $info->total_floor      = $request->total_floor;
                $info->google_map       = $request->google_map;
                $info->address          = $request->address;
                $info->description      = $request->description;
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
            'division_id'   => $request->division,
            'district_id'   => $request->district,
            'upazila_id'    => $request->upazila,
            'union_id'      => $request->union,
            'village_id'    => $request->village,   
            'status'        => 0,
            'created_by'    => $user_id,
            'country_id'   => 18,
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

    public function productSearch(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'division'       => 'nullable',
            'district'       => 'nullable',
            'upazila'        => 'nullable',
            'union'          => 'nullable',
            'village'        => 'nullable',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errorMessage = implode('<br>', $errors);
        
            if ($validator->fails()) {
                return redirect()->back()->withInput()->withErrors($validator)->with('error', 'Validation failed.');
            }
        }

        try{
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $division_id    = $request->division;
                $district_id    = $request->district;
                $upazila_id     = $request->upazila;
                $union_id       = $request->union;
                $village_id     = $request->village;
                $divisions      = $this->getCachedDivisions();
                $districts      = $this->getCachedDistricts();
                $upazilas       = $this->getCachedUpazilas();
                $unions         = $this->getCachedUnions();
                $villages       = $this->getCachedVillages();

                $selected['division_id'] = $division_id;
                $selected['district_id'] = $district_id;
                $selected['upazila_id']  = $upazila_id;
                $selected['union_id']    = $union_id;
                $selected['village_id']  = $village_id;

                $projectsQuery = Project::where('status', 1);

                if (!is_null($division_id)) {
                    $projectsQuery->where('division_id', $division_id);
                }
                if (!is_null($district_id)) {
                    $projectsQuery->where('district_id', $district_id);
                }
                if (!is_null($upazila_id)) {
                    $projectsQuery->where('upazila_id', $upazila_id);
                }
                if (!is_null($union_id)) {
                    $projectsQuery->where('union_id', $union_id);
                }
                if (!is_null($village_id)) {
                    $projectsQuery->where('village_id', $village_id);
                }
                
                $projects = $projectsQuery->select('id', 'name', 'address', 'total_floor')->get();
                $unit_headers   = Unit::where('status',1)->select('id','title')->get();

                return view('product.product_list', compact('projects','divisions','districts','upazilas','unions','villages','selected','unit_headers'));
            }
        }
        catch (\Throwable $th) {
            dd( $th);
            return redirect()->route('product.edit')->with('error', 'Something went wrong!');
         }
    }

    public function edit($id){
        $title     = "Product Edit";
        $divisions = $this->getCachedDivisions();
        $districts = $this->getCachedDistricts();
        $upazilas  = $this->getCachedUpazilas();
        $unions    = $this->getCachedUnions();
        $villages  = $this->getCachedVillages();

        $product    = Project::find($id);

        $selected['division_id']  = $product->division_id;
        $selected['district_id']  = $product->district_id;
        $selected['upazila_id']   = $product->upazila_id;
        $selected['union_id']     = $product->union_id;
        $selected['village_id']   = $product->village_id;
        return view('product.product_save', compact('title','divisions','districts','upazilas','unions', 'villages','product','selected'));
    }

    public function sold_unsold($id){
        try{
            $product = Project::find($id); 
            return view('product.sold_unsold',compact('product'));
        }catch(Exception $e){
            dd($e->getMessage());
        }
        
    }

    public function product_approve(){
        $projects       = Project::where('status',0)->with('units')->select('id','name','address','total_floor')->get();
        $unit_headers   = Unit::where('status',1)->select('id','title')->get();
        return view('product.product_approve',compact('projects','unit_headers'));
    }

    public function productApprove(Request $request) {
        if($request->has('project_id') && $request->project_id !== '' & $request->project_id !== null) {
            DB::beginTransaction();
            try {
                foreach ($request->project_id as $key => $project_id) {
                    $project = Project::where('status',0)->where('id',$project_id)->first();
                    $project->status = 1;
                    $project->save();
                }
                DB::commit();
                return redirect()->route('product.approve')->with('success', 'Status Updated Successfully');
            } catch (Exception $e) {
                DB::rollback();
                return redirect()->back()->withInput()->with('error', $e->getMessage());
            }
            
        } else {
            return redirect()->route('product.approve')->with('error', 'Something went wrong!');
        }

    }

    public function productDelete($id){
        try{ 
            $data  = Project::find($id);
            $data->delete();
            return response()->json(['success' => 'Project Deleted'],200);
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()],500);
        }
    }
}
