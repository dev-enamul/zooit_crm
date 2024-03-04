<?php

namespace App\Http\Controllers;

use App\Models\Salse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalseReturnController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {  
        return view(('return.return_list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $my_all_employee = my_all_employee(Auth::user()->id);
        $customers = Salse::where('approve_by','!=',null)
        ->where('status',1)
        ->where('is_return',0)
        ->whereHas('customer',function($q) use($my_all_employee){
            $q->whereIn('ref_id',$my_all_employee);
        })->get();  
        return view('return.return_create',compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
