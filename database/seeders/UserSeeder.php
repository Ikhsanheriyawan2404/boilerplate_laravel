<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superadmin = User::create([
            'company_id' => 1,
            'name' => 'Ikhsan Heriyawan',
            'email' => 'ikhsan@gmail.com',
            'password' => password_hash('admin123', PASSWORD_DEFAULT),
            'salary' => 4800000,
            'saldo' => 0,
            'status' => '1',
        ]);

        $superadmin->assignRole('Superadmin');
    }
}
