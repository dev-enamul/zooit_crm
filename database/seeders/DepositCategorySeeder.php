<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepositCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
               'name' => 'Regolar Deposit',
               'status' => '1'
            ],
            [
                'name' => 'Block Factory Share Deposit',
                'status' => '1'
            ], 
            [
                'name' => 'Franchise Partner Security Deposit',
                'status' => '1'
            ], 
            [
                'name' => 'Build BD Share Deposit',
                'status' => '1'
            ],
            [
                'name' => 'S.T.I Deposit',
                'status' => '1'
            ]
        ];

        DB::table('deposit_categories')->insert($datas);
    }
}
