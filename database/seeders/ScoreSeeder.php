<?php

namespace Database\Seeders;

use App\Models\Contest;
use App\Models\Round;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $round = Round::first();

        foreach($round->criterias as $crit) {
            foreach($round->contestants as $contestant) {
                foreach($round->contest->judges as $judge) {
                        \App\Models\Score::create([
                            'contestant_id' => $contestant->id,
                            'judge_id' => $judge->id,
                            'criteria_id' => $crit->id,
                            // 'round_id' => $round->id,
                            'score' => rand($crit->weight/2, $crit->weight)
                        ]);
                }
            }
        }
    }
}
