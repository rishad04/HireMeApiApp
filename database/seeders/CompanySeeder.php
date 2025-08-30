<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $company1 = new Company();
        $company1->name = 'Meta Inc.';
        $company1->slug = 'meta-inc';
        $company1->save();

        $company1 = new Company();
        $company1->name = 'Enosis';
        $company1->slug = 'enosis';
        $company1->save();

        $company1 = new Company();
        $company1->name = 'StepUp Ads Agency';
        $company1->slug = 'stepup-ads-agency';
        $company1->save();

        $company1 = new Company();
        $company1->name = 'Softvence It';
        $company1->slug = 'softvence-it';
        $company1->save();

        $company1 = new Company();
        $company1->name = 'Bdcalling It';
        $company1->slug = 'bdcalling-it';
        $company1->save();
    }
}
