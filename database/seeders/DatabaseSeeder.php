<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

 
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(FindMediaSeeder::class); 
        $this->call(RejectReasonSeeder::class); 
        $this->call(DesignationSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(CountriesSeeder::class);
        $this->call(BankSeeder::class);
        $this->call(SpecialCommissionSeeder::class); 
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
        $this->call(NegotiationWaitingDaySeeder::class);
        $this->call(VillageSeeder::class);
        $this->call(DesignationPermissionSeeder::class);
        $this->call(UserPermissionSeeder::class);
        $this->call(DepositCategorySeeder::class);
        $this->call(ReportingUserSeeder::class);
        $this->call(ApproveSettingSeeder::class); 
        $this->call(ServiceSeeder::class);
        $this->call(ProjectProposalSeeder::class);
    }
}
