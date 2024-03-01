<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('unit_categories')->delete();
        $data = [
            [
                'title' => 'A',
                'description' => 'Luxurious housing units with premium amenities.',
                'status' => 1,
            ],
            [
                'title' => 'B',
                'description' => 'Modern and spacious residential units for families.',
                'status' => 1,
            ],
            [
                'title' => 'C',
                'description' => 'Affordable housing options with essential facilities.',
                'status' => 1,
            ],
            [
                'title' => 'D',
                'description' => 'Exclusive units designed for high-end living.',
                'status' => 1,
            ],
        ];

        DB::table('unit_categories')->insert($data);
    }
}
