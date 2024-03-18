<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FreelancerImportController extends Controller
{
    public function index(){ 
        return view('freelancer.freelancer_import');
    } 

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls', // Validate file type
        ]);
        
        try {
            Excel::import(new UserImport, $request->file('file')); 
            return redirect()->back()->with('success', 'Users imported successfully.');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'Error occurred while importing users: '.$e->getMessage());
        }
    }
}
