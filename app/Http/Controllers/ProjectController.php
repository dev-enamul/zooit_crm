<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function select2_project(Request $request)
    {
        $request->validate([
            'term' => ['nullable', 'string'],
        ]);

        $term = $request->term;

        $projects = Project::query()
            ->where(function ($query) use ($term) {
                $query->where('title', 'like', "%{$term}%")
                    ->orWhere('id', 'like', "%{$term}%");
            })
            ->where('status', 1)  
            ->limit(10)
            ->get();

        $results = [
            ['id' => '', 'text' => 'Select Project']
        ];

        foreach ($projects as $project) {
            $results[] = [
                'id' => $project->id,
                'text' => "{$project->title} ({$project->customer->user->name})",
            ];
        }

        return response()->json([
            'results' => $results
        ]);
    }

}
