<?php

namespace App\Http\Controllers;

use App\Imports\UserImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

class EmployeeImportController extends Controller
{
    public function index(){ 
        return view('employee.employee_import');
    } 

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls', // Validate file type
        ]); 
        try {
            Excel::import(new UserImport, $request->file('file')); 
            return redirect()->back()->with('success', 'Users imported successfully.');
        } catch (Throwable $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'Error occurred while importing users: '.$e->getMessage());
        }
    }
}
