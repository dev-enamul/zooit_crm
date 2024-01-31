<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\District;
use App\Models\Division;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\Union;
use App\Models\Unit;
use App\Models\Upazila;
use App\Models\Village;
use App\Traits\AreaTrait;
use App\Traits\ImageUploadTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    use ImageUploadTrait;
    use AreaTrait;

    public function index(){
        $divisions      = $this->getCachedDivisions();
        $projects       = Project::where('status',1)->select('id','name','address','total_floor')->get();
        $unit_headers   = Unit::where('status',1)->select('id','title')->get();
        return view('product.product_list',compact('projects','divisions','unit_headers'));
    }

    public function create(){
        $title     = "Product Create";
        $countries = $this->getCachedCountries();
        $divisions = $this->getCachedDivisions();
        $districts = $this->getCachedDistricts();
        $upazilas  = $this->getCachedUpazilas();
        $unions    = $this->getCachedUnions();
        $villages  = $this->getCachedVillages();
        return view('product.product_save', compact('title','countries','divisions','districts','upazilas','unions','villages'));
    }

    public function save(Request $request, $id = null)
    { 
        $validator = Validator::make($request->all(), [
            'name'          => 'required|string|max:190',
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

    public function productSearch(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'division'          => 'required',
            'district'          => 'required',
            'upazila'        => 'sometimes|required',
            'union'          => 'sometimes|required',
            'village'        => 'sometimes|required',
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

                $projects  = Project::where(['status'=>1, 'division_id'=>$division_id,'district_id'=>$district_id,'upazila_id'=>$upazila_id,'union_id'=>$union_id,'village_id'=>$village_id])->select('id','name','address','total_floor')->get();
                return view('product.product_list', compact('projects','divisions','districts','upazilas','unions','villages','selected'));
            }
        }
        catch (\Throwable $th) {
            dd( $th);
            return redirect()->route('product.edit')->with('error', 'Something went wrong!');
         }
    }

    public function edit($id){
        $title     = "Product Edit";
        $countries = $this->getCachedCountries();
        $divisions = $this->getCachedDivisions();
        $districts = $this->getCachedDistricts();
        $upazilas  = $this->getCachedUpazilas();
        $unions    = $this->getCachedUnions();
        $villages  = $this->getCachedVillages();

        $product    = Project::find($id);

        $selected['country_id']   = $product->country_id;
        $selected['division_id']  = $product->division_id;
        $selected['district_id']  = $product->district_id;
        $selected['upazila_id']   = $product->upazila_id;
        $selected['union_id']     = $product->union_id;
        $selected['village_id']   = $product->village_id;
        return view('product.product_save', compact('title','countries','divisions','districts','upazilas','unions', 'villages','product','selected'));
    }

    public function sold_unsold(){
        return view('product.sold_unsold');
    }

    public function product_approve(){
        return view('product.product_approve');
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
