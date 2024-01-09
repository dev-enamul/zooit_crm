<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('training.training_list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('training.training_create');
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
    
    public function training_schedule_create(){
        return view('training.training_schedule_create');
    }

    public function training_schedule(){
        return view('training.training_schedule');
    }

    public function training_attendance(){
        return view('training.training_attendance');
    }

    public function training_history(){
        return view('training.training_history');
    }

    public function training_details(){
        return view('training.training_details');
    }
}
