<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommissionDeductedSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('commission_deducted_settings')->delete();
        $data = [
            [
                'start_amount' => 0,
                'end_amount'   => 10000,
                'deducted'     => 10
            ],
            [
                'start_amount' => 10001,
                'end_amount'   => 30000,
                'deducted'     => 10
            ] 
        ];

        DB::table('commission_deducted_settings')->insert($data);
    }
}
