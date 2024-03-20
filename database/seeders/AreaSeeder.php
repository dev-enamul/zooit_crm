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
                "name" => "Dhaka South Outer",
                "zone_id" => 1,
                "status" => 1
            ],
            [
                "name" => "Dhaka North Outer",
                "zone_id" => 1,
                "status" => 1
            ],
            [
                "name" => "Dinajpur",
                "zone_id" => 2,
                "status" => 1
            ],
            [
                "name" => "Ramgonj",
                "zone_id" => 4,
                "status" => 1
            ],
            [
                "name" => "Lakshmipur Sadar",
                "zone_id" => 4,
                "status" => 1
            ],
            [
                "name" => "Raipur",
                "zone_id" => 4,
                "status" => 1
            ],
            [
                "name" => "Chatkhil",
                "zone_id" => 3,
                "status" => 1
            ],
            [
                "name" => "Maijdee",
                "zone_id" => 3,
                "status" => 1
            ],
            [
                "name" => "Cumilla Sadar",
                "zone_id" => 7,
                "status" => 1
            ],
            [
                "name" => "Hazigonj",
                "zone_id" => 8,
                "status" => 1
            ],
            [
                "name" => "Feni",
                "zone_id" => 9,
                "status" => 1
            ],
            [
                "name" => "Chattogram",
                "zone_id" => 10,
                "status" => 1
            ],
            [
                "name" => "Companiganj",
                "zone_id" => 3,
                "status" => 1
            ],
            [
                "name" => "Chowmuhani",
                "zone_id" => 3,
                "status" => 1
            ],
            [
                "name" => "Jessore",
                "zone_id" => 5,
                "status" => 1
            ],
            [
                "name" => "Begumganj",
                "zone_id" => 3,
                "status" => 1
            ],
            [
                "name" => "Kobirhat",
                "zone_id" => 3,
                "status" => 1
            ],
            [
                "name" => "Sonaimuri",
                "zone_id" => 3,
                "status" => 1
            ],
            [
                "name" => "Senbug",
                "zone_id" => 3,
                "status" => 1
            ],
            [
                "name" => "Ramgoti",
                "zone_id" => 4,
                "status" => 1
            ],
            [
                "name" => "Komol Nagar",
                "zone_id" => 4,
                "status" => 1
            ],
            [
                "name" => "Hathazari",
                "zone_id" => 10,
                "status" => 1
            ]
        ]; 
        DB::table('areas')->insert($data);
    }
}
