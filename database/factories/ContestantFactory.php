<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contestant>
 */
class ContestantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $round = \App\Models\Round::first();

        return [
            'name' => $this->faker->name,
            'number' => $round->nextRoundNumber(),
            'remarks' => $this->faker->randomElement(['R&B','Ballad','Rock','Classical']),
            'round_id' => $round->id
        ];
    }
}
