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
        $data= [
                "Dhaka",
                "Dinajpur",
                "Noakhali",
                "Lakshmipur",
                "Jessore",
                "Narayangonj",
                "Cumilla",
                "Chandpur",
                "Feni",
                "Chattogram"
            ];
        $datas = []; 
        
        foreach($data as $zone){
            $datas[] = [
                'name' => $zone,
                'status' => 1
            ];
        }
        DB::table('zones')->insert($datas);
    }
}
