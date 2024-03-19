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
                'title' => 'Incharge Marketing',
                'commission' => 0.4,
                'status' => 1,
            ], 
            [
                'title' => 'Incharge Sales to DSM',
                'commission' => 1.1,
                'status' => 1,
            ],
            [
                'title' => 'Area Incharge',
                'commission' => 0.5,
                'status' => 1,
            ],
            [
                'title' => 'Zonal Manager',
                'commission' => 0,
                'status' => 1,
            ],  
            [
                'title' => 'Regional Manager',
                'commission' => 0.2,
                'status' => 1,
            ],
            [
                'title' => 'Sales Manager',
                'commission' => 0,
                'status' => 1,
            ],
            [
                'title' => 'A.G.M, Marketing',
                'commission' => .15,
                'status' => 1,
            ],
            [
                'title' => 'A.G.M, Sales',
                'commission' => .15,
                'status' => 1,
            ],
            [
                'title' => 'A.G.M (S & M)',
                'commission' => .1,
                'status' => 1,
            ],
            [
                'title' => 'D.G.M',
                'commission' => 0,
                'status' => 1,
            ],
            [
                'title' => 'G.M',
                'commission' => 0,
                'status' => 1,
            ],
            [
                'title' => 'M.D',
                'commission' => 0,
                'status' => 1,
            ],
            [
                'title' => 'Ziro Commission',
                'commission' => 0,
                'status' => 1,
            ]
        ];  
        DB::table('commissions')->insert($data);
    }
}
