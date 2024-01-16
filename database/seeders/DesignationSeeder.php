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
                'title' => 'Franchise Partner',
                'commission_id' => 1,
                'status' => 1,
            ],
            [
                'title' => 'Co-Ordinator Applicant',
                'commission_id' => 2,
                'status' => 1,
            ],
            [
                'title' => 'Co Ordinator',
                'commission_id' => 3,
                'status' => 1,
            ],
            [
                'title' => 'Ex.Co-Ordinator',
                'commission_id' => 4,
                'status' => 1,
            ],
            [
                'title' => 'Excutive Marketing',
                'commission_id' => 5,
                'status' => 1,
            ],
            [
                'title' => 'Junior Executive',
                'commission_id' => 6,
                'status' => 1,
            ],
            [
                'title' => 'Sales Executive',
                'commission_id' => 7,
                'status' => 1,
            ],
            [
                'title' => 'Sr. Executive',
                'commission_id' => 7,
                'status' => 1,
            ],
            [
                'title' => 'ASM',
                'commission_id' => 7,
                'status' => 1,
            ],

            [
                'title' => 'DSM',
                'commission_id' => 7,
                'status' => 1,
            ],


            [
                'title' => 'Area Incharge',
                'commission_id' => 8,
                'status' => 1,
            ],
            [
                'title' => 'Asst. Zonal Manager',
                'commission_id' => 9,
                'status' => 1,
            ],
            [
                'title' => 'Zonal Manager',
                'commission_id' => 10,
                'status' => 1,
            ],
            [
                'title' => 'Senior Zonal Manager',
                'commission_id' => 11,
                'status' => 1,
            ],
            [
                'title' => 'Zonal Co-Ordinator',
                'commission_id' => 12,
                'status' => 1,
            ],
            [
                'title' => 'Regional Manager',
                'commission_id' => 13,
                'status' => 1,
            ],
            [
                'title' => 'Sales Manager',
                'commission_id' => 14,
                'status' => 1,
            ],
            [
                'title' => 'A.G.M',
                'commission_id' => 15,
                'status' => 1,
            ],
            [
                'title' => 'D.G.M',
                'commission_id' => 16,
                'status' => 1,
            ],
            [
                'title' => 'G.M',
                'commission_id' => 17,
                'status' => 1,
            ]
        ];
 
        DB::table('designations')->insert($data);
        $this->command->info('Designations table seeded successfully.');
    }
}
