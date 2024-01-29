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
                'commission_id' => 2,
                'working_place' => 1,
                'status' => 1,
            ],
            [
                'title' => 'G.M',
                'commission_id' => 17,
                'working_place' => 1,
                'status' => 1,
            ],
            [
                'title' => 'D.G.M',
                'commission_id' => 16,
                'working_place' => 1,
                'status' => 1,
            ],
            [
                'title' => 'A.G.M',
                'commission_id' => 15,
                'working_place' => 1,
                'status' => 1,
            ],
            [
                'title' => 'Sales Manager',
                'commission_id' => 14,
                'working_place' => 1,
                'status' => 1,
            ],
            [
                'title' => 'Regional Manager',
                'working_place' => 1,
                'commission_id' => 13,
                'status' => 1,
            ],
            [
                'title' => 'Zonal Co-Ordinator',
                'working_place' => 1,
                'commission_id' => 12,
                'status' => 1,
            ],
            [
                'title' => 'Senior Zonal Manager',
                'working_place' => 1,
                'commission_id' => 11,
                'status' => 1,
            ],
            [
                'title' => 'Zonal Manager',
                'working_place' => 1,
                'commission_id' => 10,
                'status' => 1,
            ],
            [
                'title' => 'Asst. Zonal Manager',
                'working_place' => 1,
                'commission_id' => 9,
                'status' => 1,
            ], 
            [
                'title' => 'Area Incharge',
                'working_place' => 1,
                'commission_id' => 8,
                'status' => 1,
            ], 
            [
                'title' => 'DSM',
                'commission_id' => 7,
                'working_place' => 1,
                'status' => 1,
            ],[
                'title' => 'ASM',
                'commission_id' => 7,
                'working_place' => 1,
                'status' => 1,
            ],
            [
                'title' => 'Sr. Executive',
                'working_place' => 1,
                'commission_id' => 7,
                'status' => 1,
            ],
            [
                'title' => 'Sales Executive',
                'working_place' => 1,
                'commission_id' => 7,
                'status' => 1,
            ],
            [
                'title' => 'Junior Executive',
                'working_place' => 1,
                'commission_id' => 6,
                'status' => 1,
            ],
            [
                'title' => 'Excutive Marketing',
                'working_place' => 1,
                'commission_id' => 5,
                'status' => 1,
            ],
            [
                'title' => 'Ex.Co-Ordinator',
                'working_place' => 1,
                'commission_id' => 4,
                'status' => 1,
            ],
            [
                'title' => 'Co Ordinator',
                'working_place' => 1,
                'commission_id' => 3,
                'status' => 1,
            ],
            [
                'title' => 'Co-Ordinator Applicant',
                'working_place' => 1,
                'commission_id' => 2,
                'status' => 1,
            ],
            [
                'title' => 'Franchise Partner',
                'working_place' => 1,
                'commission_id' => 1,
                'status' => 1,
            ],
        ];
 
        DB::table('designations')->insert($data);
        $this->command->info('Designations table seeded successfully.');
    }
}
