<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommonController extends Controller
{
    public function all_employee(Request $request){
        $request->validate([
            'term' => ['nullable', 'string'],
        ]); 

        $users = User::query()
            ->where(function ($query) use ($request) {
                $term = $request->term;
                $query->where('user_id', 'like', "%{$term}%")
                    ->orWhere('name', 'like', "%{$term}%");
            }) 
            ->where('status', 1)
            ->limit(10)
            ->get();
    
        $results = [
            ['id' => '', 'text' => 'Select Product']
        ];
    
        foreach ($users as $user) {
            $results[] = [
                'id' => $user->id,
                'text' => "{$user->name} ($user->user_id)", 
            ];
            
        }
        return response()->json([
            'results' => $results
        ]);
    }
}
