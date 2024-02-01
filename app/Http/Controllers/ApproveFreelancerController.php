<?php

namespace App\Http\Controllers;

use App\Models\TrainingCategory;
use App\Models\User;
use Illuminate\Http\Request;

class ApproveFreelancerController extends Controller
{
    
    public function index()
    {
        $trainings = TrainingCategory::where('status', '1')->get();
        $datas = User::where('user_type', '2')->where('approve_by',null)->get();
        return view('freelancer.approve-freelancer',compact('datas','trainings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
