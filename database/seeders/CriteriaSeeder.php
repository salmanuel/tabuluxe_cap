<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $criterias = [
            [
                'name' => 'Voice Quality',
                'description' => 'Voice Quality',
                'weight' => 40
            ],
            [
                'name' => 'Diction & Timing',
                'description' => 'Diction & Timing',
                'weight' => 30
            ],
            [
                'name' => 'Stage Presence',
                'description' => 'Stage Presence',
                'weight' => 30
            ],
        ];

        foreach($criterias as $crit) {
            $criteria = \App\Models\Criteria::create([
                'name' => $crit['name'],
                'description' => $crit['description'],
                'weight' => $crit['weight'],
                'contest_id' => 1,
            ]);

            foreach($criteria->contest->contestants as $contestant) {
                foreach($criteria->contest->judges as $judge) {
                    \App\Models\Score::create([
                        'contestant_id' => $contestant->id,
                        'judge_id' => $judge->id,
                        'criteria_id' => $criteria->id,
                        'score' => rand($criteria->weight/2, $criteria->weight)
                    ]);
                }
            }
        }
    }
}
