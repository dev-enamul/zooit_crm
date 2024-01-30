<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('banks')->delete();
        $datas = [
            ['name' => 'Sonali Bank Limited', 'type' => '0', 'account_number' => '1001001', 'status' => 1],
            ['name' => 'Agrani Bank Limited', 'type' => '0', 'account_number' => '1001002', 'status' => 1],
            ['name' => 'Janata Bank Limited', 'type' => '0', 'account_number' => '1001003', 'status' => 1],
            ['name' => 'Rupali Bank Limited', 'type' => '0', 'account_number' => '1001004', 'status' => 1],
            ['name' => 'Islami Bank Bangladesh Limited', 'type' => '0', 'account_number' => '1001005', 'status' => 1],
            ['name' => 'Brac Bank Limited', 'type' => '0', 'account_number' => '1001006', 'status' => 1],
            ['name' => 'Dutch-Bangla Bank Limited', 'type' => '0', 'account_number' => '1001007', 'status' => 1],
            ['name' => 'Eastern Bank Limited', 'type' => '0', 'account_number' => '1001008', 'status' => 1],
            ['name' => 'United Commercial Bank Limited', 'type' => '0', 'account_number' => '1001009', 'status' => 1],
            ['name' => 'Bangladesh Krishi Bank', 'type' => '0', 'account_number' => '1001010', 'status' => 1],
            ['name' => 'bKash', 'type' => '1', 'account_number' => '3003001', 'status' => 1],
            ['name' => 'Rocket', 'type' => '1', 'account_number' => '3003002', 'status' => 1],
            ['name' => 'Nagad', 'type' => '1', 'account_number' => '3003003', 'status' => 1],
        ]; 
        
        DB::table('banks')->insert($datas);
        $this->command->info('Banks seeded successfully.');
    }
}
