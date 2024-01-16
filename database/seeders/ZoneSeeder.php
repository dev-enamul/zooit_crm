<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('zones')->delete();
        $data = [ 
            [
                'name'=>'Dhaka',
                'status' => 1
            ],
            [
                'name'=>'Rajshahi',
                'status' => 1
            ],
            [
                'name'=>'Naogaon',
                'status' => 1,
            ]
        ];
        DB::table('zones')->insert($data);
    }
}
