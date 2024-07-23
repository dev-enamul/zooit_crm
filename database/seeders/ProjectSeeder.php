<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('projects')->delete();
        
        $professions = [
            'Corporate Web Development',
            'Software Development',
            'CRM Software',
            'SASS Software',  
        ];
 
        foreach ($professions as $profession) {
            Project::create(['name' => $profession]);
        } 
    }
}
