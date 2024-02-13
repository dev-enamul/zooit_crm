<?php

namespace App\Http\Controllers;

use App\Enums\Priority;
use App\Enums\ProspectingMedia;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Profession;
use App\Models\Prospecting;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProspectingController extends Controller
{
    public function prospectingMedia()
    {
        return ProspectingMedia::values();
    }

    public function priority()
    {
        return Priority::values();
    }

    public function index(Request $request)
    {

        if($request->filled('join_date')) {
            $professions = Profession::all();

            $employee = (int)$request->employee;
            $my_all_employee = my_all_employee($employee);
            $employee_data = Customer::whereIn('ref_id', $my_all_employee)->get();
            $employees = User::whereIn('id', $my_all_employee)->get();
            $prospectings = Prospecting::whereHas('customer', function($q) use($my_all_employee){ 
                $q->whereIn('ref_id', $my_all_employee);
            })->get(); 
        }else {
            $customer = Customer::select('id','name')->get();

            $professions = Profession::all();
            $my_all_employee = my_all_employee(auth()->user()->id);
            $employee_data = Customer::whereIn('ref_id', $my_all_employee)->get();
            $employees = User::whereIn('id', $my_all_employee)->get();

            $prospectings = Prospecting::whereHas('customer', function($q) use($my_all_employee){ 
                    $q->whereIn('ref_id', $my_all_employee);
                })->get(); 
        }
        
        return view('prospecting.prospecting_list', compact('prospectings','employee_data','professions','employees'));
    }

    public function create()
    {
        $title = 'Prospecting Entry';
        $user_id   = Auth::user()->id; 
        $my_all_employee = my_all_employee($user_id);
        $customers = Customer::whereIn('ref_id', $my_all_employee)->get();
        $employees = User::whereIn('id', $my_all_employee)->get();
        $prospectingMedias = $this->prospectingMedia();
        $priorities = $this->priority();

        return view('prospecting.prospecting_save', compact('customers','prospectingMedias','priorities','title','employees'));
    }


    public function save(Request $request, $id = null)
    {
        $validator = Validator::make($request->all(), [
            'media'         => 'required',
            'priority'      => 'required',
            'customer'      => 'required',
            'employee'      => 'required',
            'remark'        => 'nullable|string|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator)->with('error', $validator->errors()->first());
        }

        if (!empty($id)) {
            $prospecting = Prospecting::find($id);
            $prospecting->update([
                'media'         => $request->media,
                'priority'      => $request->priority,
                'remark'        => $request->remark,
                'customer_id'   => $request->customer,
                'employee_id'   => $request->employee,
                'created_by'    => auth()->id(),
                'created_at'     => now(),
            ]);
            return redirect()->route('prospecting.index')->with('success','Prospecting update successfully');

        } else {
            $prospecting = new Prospecting();
            $prospecting->media         = $request->media;
            $prospecting->priority      = $request->priority;
            $prospecting->remark        = $request->remark;
            $prospecting->customer_id   = $request->customer;
            $prospecting->employee_id   = $request->employee;
            $prospecting->created_by    = auth()->id();
            $prospecting->created_at    = now();
            $prospecting->save();
            return redirect()->route('prospecting.index')->with('success','Prospecting create successfully');
        }
    }

    public function edit(string $id)
    {
        $title = 'Prospecting Edit';
        $prospecting = Prospecting::find($id);
        $user_id   = Auth::user()->id; 
        $my_all_employee = my_all_employee($user_id);
        $customers = Customer::whereIn('ref_id', $my_all_employee)->get();
        $employees = User::whereIn('id', $my_all_employee)->get();
        $prospectingMedias = $this->prospectingMedia();
        $priorities = $this->priority();

        return view('prospecting.prospecting_save', compact('prospecting','customers','employees','prospectingMedias','priorities','title'));
    }

    public function prospectingDelete($id){
        try{ 
            $data  = Prospecting::find($id);
            $data->delete();
            return response()->json(['success' => 'Prospecting Deleted'],200);
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()],500);
        }
    }
}
