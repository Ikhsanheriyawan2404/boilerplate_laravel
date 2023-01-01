<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::create([
            'name' => 'PT Surya Sejahtera',
            'agreement_document' => fake()->name(),
            'npwp' => fake()->name(),
            'business_doc' => fake()->name(),
            'cutoff_date' => fake()->date(),
            'payroll_date' => fake()->date(),
            'join_date' => fake()->date(),
            'end_date' => fake()->date(),
            'name_pic' => fake()->name(),
            'email_pic' => fake()->email(),
            'phone_pic' => fake()->phonenumber(),
            'working_days' => 25,
        ]);
    }
}
