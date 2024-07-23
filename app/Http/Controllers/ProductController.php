<?php

namespace App\Http\Controllers;

use App\Models\ApproveSetting;
use App\Models\Notification;
use Exception;
use App\Models\Unit;
use App\Models\Project;
use App\Traits\AreaTrait;
use App\Models\ProjectImage;
use App\Models\Salse;
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
        $projects       = Project::where('status',1)->get();  
        return view('product.product_list',compact('projects'));
    }

    public function create(){
        $title     = "Product Create"; 
        return view('product.product_save', compact('title'));
    }

    public function save(Request $request, $id = null)
    {
 
        $validator = Validator::make($request->all(), [
            'name'          => 'required|string|max:190', 
            'price'          => 'nullable|integer', 
            'description'   => 'nullable|string|max:5000',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3072',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator)->with('error', 'Validation failed.');
        }

        $user_id = Auth::user()->id;
        $approve_setting = ApproveSetting::where('name','product')->first();
        $is_admin = Auth::user()->hasPermission('admin');

        if (!empty($id)) {
            $info = Project::find($id); 
            if (!empty($info)){
                $info->name             = $request->name;
                $info->price             = $request->price; 
                $info->description      = $request->description;     
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
            'price'          => $request->price, 
            'description'   => $request->description, 
            'status'        => 1, 
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
                    $project->approved_by = Auth::user()->id;
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
