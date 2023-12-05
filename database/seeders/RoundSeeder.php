<?php

namespace Database\Seeders;

use App\Models\Round;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoundSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rounds = [
            [
                'contest_id' => 1,
                'number' => 1,
                'description' => 'Elimination Round',
                'next_round_id' => null
            ],
            // [
            //     'contest_id' => 1,
            //     'number' => 2,
            //     'description' => 'Semi-final',
            //     'next_round_id' => null
            // ]
        ];

        foreach($rounds as $rnd) {
            $round = \App\Models\Round::create([
                'contest_id' => $rnd['contest_id'],
                'number' => $rnd['number'],
                'description' => $rnd['description'],
                'next_round_id' => $rnd['next_round_id'],
            ]);
        }
    }
}
