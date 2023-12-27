<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RejectionController extends Controller
{
     
    public function index()
    {
        return view('rejection.rejection_list');
    }

   
    public function create()
    {
        return view('rejection.rejection_create');
    }

    
    public function store(Request $request)
    {
        //
    }

 
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
