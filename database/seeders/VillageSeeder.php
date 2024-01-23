<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VillageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
               'name' => 'Chalkmothor',
               'union_id' => 1,
               'word_no' => 12,
               'status' => 1
            ],
            [
                'name' => 'Faijabad',
                'union_id' => 1,
                'word_no' => 12,
                'status' => 1
             ],
             [
                'name' => 'Paharpur',
                'union_id' => 1,
                'word_no' => 12,
                'status' => 1
             ],
             [
                'name' => 'Mohammadpur',
                'union_id' => 1,
                'word_no' => 12,
                'status' => 1
             ],
             [
                'name' => 'Bosila',
                'union_id' => 1,
                'word_no' => 12,
                'status' => 1
             ],
        ];

        DB::table('villages')->insert($datas);
    }
}
