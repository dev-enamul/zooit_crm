<?php

namespace Database\Seeders;

use App\Models\CompanyType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('professions')->delete();
        
        $professions = [
            'Architectural Design',
            'Software Development',
            'Construction Farm',
            'Ecommerce',  
        ];
 
        foreach ($professions as $profession) {
            CompanyType::create(['name' => $profession]);
        } 
    }
}
