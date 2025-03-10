<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Complain>
 */
class ComplainFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "cnic" => fake()->phoneNumber(),
            "complain" => fake()->sentence(),
            "type_id" => 1,
            "question_id" => 1,
            "highlighted" => fake()->boolean(),
            "membership_number" => fake()->numberBetween(1, 100),
        ];
    }
}
