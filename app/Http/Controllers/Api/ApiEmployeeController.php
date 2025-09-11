<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiEmployeeController extends Controller
{
    public function employees(Request $request)
    {
        $project_id = $request->project_id;

        if ($project_id) { 
            $employees = DB::table('employees')
                ->join('users', 'employees.user_id', '=', 'users.id')
                ->join('project_teams', 'users.id', '=', 'project_teams.user_id')
                ->where('employees.status', 1)
                ->where('project_teams.project_id', $project_id)
                ->select(
                    'users.name',
                    'users.id as user_id',
                    'employees.id as employee_id'
                )
                ->get();
        } else { 
            $employees = DB::table('employees')
                ->join('users', 'employees.user_id', '=', 'users.id')
                ->where('employees.status', 1)
                ->select(
                    'users.name',
                    'users.id as user_id',
                    'employees.id as employee_id'
                )
                ->get();
        }

        return success_response($employees); 
    }


}
