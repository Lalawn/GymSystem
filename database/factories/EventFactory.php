<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'event_date' => $this->faker->dateTimeBetween('-7 days', 'now'),
            'description' => $this->faker->text(),
            'author_id' => User::all()->random()->id,
            'trainer_id' => User::all()->random()->id
        ];
    }
}
