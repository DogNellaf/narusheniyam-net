<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Violation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Violation>
 */
class ViolationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id'     => User::factory(),
            'description' => fake()->sentence(10),
            'number'      => strtoupper(fake()->bothify('?###??##')),
            'status'      => Violation::STATUS_NEW,
        ];
    }

    public function confirmed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => Violation::STATUS_CONFIRMED,
        ]);
    }

    public function rejected(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => Violation::STATUS_REJECTED,
        ]);
    }
}
