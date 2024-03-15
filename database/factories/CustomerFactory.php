<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => User::generateNextCustomerId(),
            'user_id' => 22,
            'profession_id' => $this->faker->numberBetween(1, 6),
            'name' => $this->faker->name,
            'ref_id' => $this->faker->numberBetween(5, 12),
            'approve_by' => $this->faker->numberBetween(5, 12),
            'status' => 0,
            'created_by' => 1,
        ];
    }
}
