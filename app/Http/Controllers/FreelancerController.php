<?php

namespace App\Http\Controllers;

use App\Models\Freelancer;
use App\Models\Profession;
use App\Traits\AreaTrait;
use App\Traits\ImageUploadTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FreelancerController extends Controller
{
    use AreaTrait;
    use ImageUploadTrait;

    public function index(){ 
        $datas=  Freelancer::where('status',1)->get();
        return view('freelancer.freelancer_list',compact('datas'));
    }

    public function create(){
        $title     = "Freelancer Create";
        $countries = $this->getCachedCountries();
        $divisions = $this->getCachedDivisions();
        $districts = $this->getCachedDistricts();
        $upazilas  = $this->getCachedUpazilas();
        $unions    = $this->getCachedUnions();
        $villages  = $this->getCachedVillages();
        $professions = Profession::where('status',1)->select('id','name')->get();
        
        return view('freelancer.freelancer_save', compact('title','countries','divisions','districts','upazilas','unions','villages'));
    }
    
    public function save(Request $request, $id = null)
    {
        dd($request->all()); 
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

            $info = Freelancer::find($id);

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

                    // if ($request->hasFile('image')) {
                    //     $p_images = new ProjectImage();
                    //     $p_images->project_id = $info->id;
                    //     $p_images->name =   $this->uploadImage($request, 'image', 'projects', 'public'); 
                    //     $p_images->save();
                    // }
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
            'status'        => 0,
            'created_by'    => $user_id,
        ];

        DB::beginTransaction();
        try {
            $project = Freelancer::create($data);
            
            // if ($request->hasFile('image')) {
            //     $p_images = new ProjectImage();
            //     $p_images->project_id = $project->id;
            //     $p_images->name =   $this->uploadImage($request, 'image', 'projects', 'public'); 
            //     $p_images->save();
            // }
            DB::commit();
            
            return redirect()->route('product.index')->with('success', 'Project created successfully');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }
    
}
