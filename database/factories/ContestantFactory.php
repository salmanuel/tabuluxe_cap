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
        $contest = \App\Models\Contest::first();

        return [
            'name' => $this->faker->name,
            'number' => $contest->nextContestantNumber(),
            'remarks' => $this->faker->randomElement(['R&B','Ballad','Rock','Classical']),
            'contest_id' => $contest->id
        ];
    }
}
