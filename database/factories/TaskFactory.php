<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->randomElement([
                '水筒洗い',
                '箸箱洗い',
                'お風呂掃除',
                'ゴミ捨て',
                'エサやり',
            ]),
            'amount' => fake()->numberBetween(10, 100),
            'done_at' => fake()->dateTimeBetween('-1 week', 'now'),
        ];
    }
}
