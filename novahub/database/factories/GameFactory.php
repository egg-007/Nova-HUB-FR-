<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Game>
 */
class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'developer_id' => User::factory()->state(['role' => 'company']),
            'title' => fake()->sentence(3),
            'description' => fake()->paragraph(),
            'price' => fake()->randomFloat(2, 0, 100),
            'status' => fake()->randomElement(['pending', 'approved', 'rejected']),
            'image' => fake()->imageUrl(640, 480, 'games', true),
            'release_date' => fake()->date(),
        ];
    }
}
