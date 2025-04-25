<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ApiTaskController extends Controller
{
    public function projects(Request $request)
    {
        $query = Project::where('status', 1)
            ->select('id', 'title')
            ->latest()
            ->take(20);

        if ($request->has('title') && $request->name !== null) {
            $query->where('title', 'LIKE', '%' . $request->title . '%');
        }

        $datas = $query->get();

        return response()->json([
            'success' => true,
            'data' => $datas
        ]);
    }

}
