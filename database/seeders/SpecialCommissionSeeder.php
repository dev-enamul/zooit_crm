<?php

namespace Database\Seeders;

use App\Models\SpecialCommission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecialCommissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('special_commissions')->delete();
        SpecialCommission::create([
            'title' => 'New Year',
            'status' => 1,
        ]);

        SpecialCommission::create([
            'title' => '11.11',
            'status' => 1,
        ]); 

        $this->command->info('Special Commissions table seeded successfully.');
    }
}
