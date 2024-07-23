<?php

namespace Database\Seeders;

use App\Models\SubProject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sub_projects')->delete();
        
        $projects = [
            'Corporate Web Development',
            'Software Development',
            'CRM Software',
            'SASS Software',  
        ];
 
        foreach ($projects as $project) {
            SubProject::create(['name' => $project, 'project_id' => 1]);
        } 
    }
}
