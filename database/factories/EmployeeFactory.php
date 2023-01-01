<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = fake()->name();

        return [
            'name' => fake()->company(),
            'company_id' => random_int(1, 100),
            'name' => $name,
            'email' => fake()->unique()->email(),
            'phone_number' => fake()->phonenumber(),
            'bank_name' => fake()->name(),
            'account_number' => fake()->date(),
            'account_name' => $name,
            'status' => '1',
        ];
    }
}
