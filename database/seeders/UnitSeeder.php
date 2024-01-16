<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('units')->delete();
        $data = [
            ['title' => 'Shop', 'down_payment' => 5000, 'booking' => 5000, 'status' => 1],
            ['title' => 'Flat', 'down_payment' => 10000, 'booking' => 10000, 'status' => 1],
            ['title' => 'Apartment', 'down_payment' => 15000, 'booking' => 15000, 'status' => 1],
            ['title' => 'Garage', 'down_payment' => 25000, 'booking' => 25000, 'status' => 1],
          
        ];

        DB::table('units')->insert($data);
    }
}
