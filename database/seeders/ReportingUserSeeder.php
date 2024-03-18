<?php

namespace Database\Seeders;

use App\Models\ReportingUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReportingUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $datas = [
            [
                "user_id" => 1,
                "reporting_user_id" => null,
            ],

            // [
            //     "user_id" => 2,
            //     "reporting_user_id" => 1,
            // ],
            // [
            //     "user_id" => 3,
            //     "reporting_user_id" => 2,
            // ],
            // [
            //     "user_id" => 4,
            //     "reporting_user_id" => 2,
            // ],
            // [
            //     "user_id" => 5,
            //     "reporting_user_id" => 2,
            // ], 
            // [
            //     "user_id" => 6,
            //     "reporting_user_id" => 5,
            // ],
            // [
            //     "user_id" => 7,
            //     "reporting_user_id" => 5,
            // ],
            // [
            //     "user_id" => 8,
            //     "reporting_user_id" => 5,
            // ],
            // [
            //     "user_id" => 9,
            //     "reporting_user_id" => 5,
            // ],
            // [
            //     "user_id" => 10,
            //     "reporting_user_id" => 5,
            // ],
            // [
            //     "user_id" => 11,
            //     "reporting_user_id" => 9,
            // ],
            // [
            //     "user_id" => 12,
            //     "reporting_user_id" => 11,
            // ],
            // [
            //     "user_id" => 12,
            //     "reporting_user_id" => 11,
            // ],
            // [
            //     "user_id" => 13,
            //     "reporting_user_id" => 11,
            // ],
            // [
            //     "user_id" => 14,
            //     "reporting_user_id" => 11,
            // ],
            // [
            //     "user_id" => 15,
            //     "reporting_user_id" => 11,
            // ],
            // [
            //     "user_id" => 16,
            //     "reporting_user_id" => 11,
            // ],
            // [
            //     "user_id" => 17,
            //     "reporting_user_id" => 15,
            // ],
            // [
            //     "user_id" => 18,
            //     "reporting_user_id" => 17,
            // ],
            // [
            //     "user_id" => 19,
            //     "reporting_user_id" => 17,
            // ],
            // [
            //     "user_id" => 20,
            //     "reporting_user_id" => 17,
            // ],
            // [
            //     "user_id" => 21,
            //     "reporting_user_id" => 17,
            // ],

        ]; 
        foreach ($datas as $data) {
            ReportingUser::create($data);
        }
    }
}
