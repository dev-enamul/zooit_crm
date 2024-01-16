<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommissionSpecialCommissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('commission_special_commissions')->delete();
        $data = [ 
            [
                'commissions_id'=> 1,
                'special_commissions_id' => 1,
                'commission' => 1
            ],
            [
                'commissions_id'=> 2,
                'special_commissions_id' => 1,
                'commission' => 1.1
            ],
            [
                'commissions_id'=> 3,
                'special_commissions_id' => 1,
                'commission' => 0.1
            ],
            [
                'commissions_id'=> 4,
                'special_commissions_id' => 0.50,
                'commission' => 1
            ],
            [
                'commissions_id'=> 5,
                'special_commissions_id' => 1,
                'commission' => 1
            ],
            [
                'commissions_id'=> 6,
                'special_commissions_id' => 1,
                'commission' => 1
            ],
            [
                'commissions_id'=> 7,
                'special_commissions_id' => 1,
                'commission' => 1
            ],
            [
                'commissions_id'=> 8,
                'special_commissions_id' => 1,
                'commission' => 1
            ],
            [
                'commissions_id'=> 9,
                'special_commissions_id' => 1,
                'commission' => 1
            ],
            [
                'commissions_id'=> 10,
                'special_commissions_id' => 1,
                'commission' => 1
            ],
            [
                'commissions_id'=> 11,
                'special_commissions_id' => 1,
                'commission' => 1
            ],
            [
                'commissions_id'=> 12,
                'special_commissions_id' => 1,
                'commission' => 1
            ],
            [
                'commissions_id'=> 13,
                'special_commissions_id' => 1,
                'commission' => 1
            ],
            [
                'commissions_id'=> 14,
                'special_commissions_id' => 1,
                'commission' => 1
            ],
            [
                'commissions_id'=> 15,
                'special_commissions_id' => 1,
                'commission' => 1
            ],
            [
                'commissions_id'=> 16,
                'special_commissions_id' => 1,
                'commission' => 1
            ],
            [
                'commissions_id'=> 17,
                'special_commissions_id' => 1,
                'commission' => 1
            ],
        ];

        DB::table('commission_special_commissions')->insert($data);
    }
}
