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
                'title' => 'M.D',  
                'working_place' => 1,
                'designation_type' => 1,
                'status' => 1,
            ],
            [
                'title' => 'E.D, Business Operation',  
                'working_place' => 1,
                'designation_type' => 1,
                'status' => 1,
            ],
            [
                'title' => 'G.M', 
                'working_place' => 1,
                'designation_type' => 1,
                'status' => 1,
            ],
            [
                'title' => 'D.G.M', 
                'working_place' => 1,
                'designation_type' => 1,
                'status' => 1,
            ],
            [
                'title' => 'A.G.M (S & M)', 
                'working_place' => 1,
                'designation_type' => 1,
                'status' => 1,
            ],
            [
                'title' => 'A.G.M, Sales', 
                'working_place' => 1,
                'designation_type' => 1,
                'status' => 1,
            ],
            [
                'title' => 'A.G.M, Marketing', 
                'working_place' => 1,
                'designation_type' => 1,
                'status' => 1,
            ],
            [
                'title' => 'Sales Manager', 
                'working_place' => 1,
                'designation_type' => 1,
                'status' => 1,
            ],
            [
                'title' => 'Regional Manager',
                'working_place' => 1, 
                'designation_type' => 1,
                'status' => 1,
            ], 
            [
                'title' => 'Zonal Manager',
                'working_place' => 1, 
                'designation_type' => 1,
                'status' => 1,
            ],  
            [
                'title' => 'Area Incharge',
                'working_place' => 1, 
                'designation_type' => 1,
                'status' => 1,
            ], 
            [
                'title' => 'DSM', 
                'working_place' => 1,
                'designation_type' => 1,
                'status' => 1,
            ],[
                'title' => 'ASM', 
                'working_place' => 1,
                'designation_type' => 1,
                'status' => 1,
            ],
            [
                'title' => 'Sr. Executive',
                'working_place' => 1, 
                'designation_type' => 1,
                'status' => 1,
            ],
            [
                'title' => 'Incharge Sales',
                'working_place' => 1, 
                'designation_type' => 1,
                'status' => 1,
            ], 
            [
                'title' => 'Incharge Marketing',
                'working_place' => 1, 
                'designation_type' => 1,
                'status' => 1,
            ],
            [
                'title' => 'Ex.Co-Ordinator',
                'working_place' => 1, 
                'designation_type' => 2,
                'status' => 1,
            ],
            [
                'title' => 'Co Ordinator',
                'working_place' => 1, 
                'designation_type' => 2,
                'status' => 1,
            ],
            [
                'title' => 'Co-Ordinator Applicant',
                'working_place' => 1, 
                'designation_type' => 2,
                'status' => 1,
            ],
            [
                'title' => 'Franchise Partner',
                'working_place' => 1, 
                'designation_type' => 2,
                'status' => 1,
            ],
        ];
 
        DB::table('designations')->insert($data);
        $this->command->info('Designations table seeded successfully.');
    }
}
