<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('commissions')->delete();
        $data = [
            [
                'title' => 'Franchise Partner',
                'commission' => 3,
                'status' => 1,
            ],
            [
                'title' => 'Co-Ordinator Applicant',
                'commission' => 0,
                'status' => 1,
            ],
            [
                'title' => 'Co Ordinator',
                'commission' => 1,
                'status' => 1,
            ],
            [
                'title' => 'Ex.Co-Ordinator',
                'commission' => 0.25,
                'status' => 1,
            ],
            [
                'title' => 'Excutive Marketing',
                'commission' => 0.4,
                'status' => 1,
            ],
            [
                'title' => 'Junior Executive',
                'commission' => 0,
                'status' => 1,
            ],
            [
                'title' => 'Sales Executive to DSM',
                'commission' => 1.1,
                'status' => 1,
            ],
            [
                'title' => 'Area Incharge',
                'commission' => 0.6,
                'status' => 1,
            ],
            [
                'title' => 'Asst. Zonal Manager',
                'commission' => 0.2,
                'status' => 1,
            ],
            [
                'title' => 'Zonal Manager',
                'commission' => 0.2,
                'status' => 1,
            ],
            [
                'title' => 'Senior Zonal Manager',
                'commission' => 0.2,
                'status' => 1,
            ],
            [
                'title' => 'Zonal Co-Ordinator',
                'commission' => 0,
                'status' => 1,
            ],
            [
                'title' => 'Regional Manager',
                'commission' => 0.15,
                'status' => 1,
            ],
            [
                'title' => 'Sales Manager',
                'commission' => 0,
                'status' => 1,
            ],
            [
                'title' => 'A.G.M',
                'commission' => 0,
                'status' => 1,
            ],
            [
                'title' => 'D.G.M',
                'commission' => 0,
                'status' => 1,
            ],
            [
                'title' => 'G.M',
                'commission' => 0.1,
                'status' => 1,
            ]
        ];  
        DB::table('commissions')->insert($data);
    }
}
