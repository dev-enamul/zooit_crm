<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\CommissionDeductedSetting;
use App\Models\NegotiationWaitingDay;
use App\Models\TrainingCategory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UsersSeeder::class); 
        $this->call(CountriesSeeder::class); 
        $this->call(ProfessionsSeeder::class); 
        $this->call(CommissionSeeder::class); 
        $this->call(BankSeeder::class);
        $this->call(DesignationSeeder::class);  
        $this->call(SpecialCommissionSeeder::class); 
        $this->call(CommissionSpecialCommissionSeeder::class);
        $this->call(CommissionDeductedSettingSeeder::class); 
        $this->call(TrainingCategorySeeder::class); 
        $this->call(UnitSeeder::class); 
        $this->call(UnitCategorySeeder::class); 
        $this->call(DivisionSeeder::class); 
        $this->call(DistrictSeeder::class); 
        $this->call(UpazilaSeeder::class); 
        $this->call(UnionSeeder::class); 
        $this->call(ZoneSeeder::class); 
        $this->call(AreaSeeder::class); 
        $this->call(PermissionSeeder::class); 
        $this->call(NegotiationWaitingDay::class);
        $this->call(VillageSeeder::class);
    }
}
