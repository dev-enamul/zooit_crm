<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\UserPermission;
use Brian2694\Toastr\Facades\Toastr as FacadesToastr;
use Brian2694\Toastr\Toastr;
use Illuminate\Http\Request; 

class PermissionController extends Controller
{
    
    public function index()
    {
        $datas = Permission::latest()->get();
        return view('setting.permission',compact('datas'));
    }

     
    public function store(Request $request)
    {
        $input = $request->all();
        $input['slug'] = getSlug(Permission::class, $request->name);
        $permission = Permission::create($input);  
        UserPermission::create(['permission_id'=>$permission->id,'user_id'=>auth()->user()->id]);
        return redirect()->back()->with('success','Permission Created');
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
