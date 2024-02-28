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
                'name' => 'Regular',
                'status' => '1'
            ], 
            [
               'name' => 'Down Payment',
               'status' => '1'
            ], 
            [
                'name' => 'Booking',
                'status' => '1'
            ], 

            [
                'name' => 'Block Factory Share',
                'status' => '1'
            ], 
            [
                'name' => 'Franchise Partner Security',
                'status' => '1'
            ], 
            [
                'name' => 'Build BD Share',
                'status' => '1'
            ],
            [
                'name' => 'S.T.I',
                'status' => '1'
            ]
        ];

        DB::table('deposit_categories')->insert($datas);
    }
}
