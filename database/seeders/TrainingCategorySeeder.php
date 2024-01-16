<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TrainingCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('training_categories')->delete();
        $data = [ 
            [
                'title'=> 'Strategic Selling in Real Estate',
                'status' => 1
            ],
            [
                'title'=> 'Digital Marketing Strategies',
                'status' => 1
            ],
            [
                'title'=> 'Customer-Centric Approaches',
                'status' => 1
            ],
            [
                'title'=> 'Effective Negotiation Techniques',
                'status' => 1
            ],
            [
                'title'=> 'Social Media Marketing',
                'status' => 1
            ],
            [
                'title'=> 'Understanding Trends',
                'status' => 1
            ],
            [
                'title'=> 'Building and Managing',
                'status' => 1
            ],
            [
                'title'=> 'Investment Fundamentals',
                'status' => 1
            ]
        ];

        DB::table('training_categories')->insert($data);
    }
}
