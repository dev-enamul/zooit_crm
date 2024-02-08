<?php

namespace App\Http\Controllers;

use App\Enums\Priority;
use App\Enums\ProspectingMedia;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Prospecting;
use Exception;
use Illuminate\Http\Request;
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

    public function index()
    {
        $prospectings = Customer::select('id','name')->get();

        return view('prospecting.prospecting_list', compact('prospectings'));
    }

    public function create()
    {
        $title = 'Prospecting Entry';
        $customers = Customer::with('user')->get();
        $employees = Employee::with('user')->get();
        $prospectingMedias = $this->prospectingMedia();
        $priorities = $this->priority();

        return view('prospecting.prospecting_save', compact('customers','prospectingMedias','priorities','title'));
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
            return redirect()->back()->withInput()->withErrors($validator)->with('error', 'Validation failed.');
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
        }
    }

    public function edit(string $id)
    {
        $title = 'Prospecting Edit';
        $prospecting = Prospecting::find($id);
        $customers = Customer::with('user')->get();
        $employees = Employee::with('user')->get();
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
