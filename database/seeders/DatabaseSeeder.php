<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Company;
use App\Models\Employee;
use App\Models\Transaction;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            CompanySeeder::class,
        ]);

        Company::factory(10)->create();
        // Employee::factory(100)->create();
        User::factory(100)->create();
        Transaction::factory(100)->create();
    }
}
