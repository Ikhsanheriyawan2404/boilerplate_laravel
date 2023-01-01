<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->company(),
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
            'working_days' => random_int(0, 1) ? 21 : 26,
        ];
    }
}
