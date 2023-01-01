<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $status = ['pending', 'success', 'failed'];
        return [
            'uuid' => fake()->uuid(),
            'user_id' => random_int(2, 100),
            'amount' => 500000,
            'payment_method' => 'Bank Transfer',
            'status' => $status[array_rand($status)],
        ];
    }
}
