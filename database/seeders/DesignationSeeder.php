<?php

namespace Database\Seeders;

use App\Models\Designation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('designations')->delete();
        $data = [
            [
                'title' => 'Admin',  
                'working_place' => 1,
                'designation_type' => 1,
                'status' => 1,
            ], 
        ];
 
        DB::table('designations')->insert($data);
        $this->command->info('Designations table seeded successfully.');
    }
}
