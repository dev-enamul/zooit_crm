<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('areas')->delete();
        $data = [ 
            [
                'name'=>'Dhaka',
                'zone_id' => 1,
                'status' => 1
            ],
            [
                'name'=>'Rajshahi',
                'zone_id' => 1,
                'status' => 1
            ],
            [
                'name'=>'Naogaon',
                'zone_id' => 1,
                'status' => 1,
            ]
        ];
        DB::table('areas')->insert($data);
    }
}
