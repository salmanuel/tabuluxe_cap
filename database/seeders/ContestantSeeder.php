<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContestantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\Contestant::factory(10)->create();
        $cnt = [
            [
                'round_id' => 1,
                'name'=>'Jenny Vials',
                'remarks' => 'Yes',
                'number'=>1
            ],
            [
                'round_id' => 1,
                'name'=>'Schetznia Algova',
                'remarks' => "Yesn't",
                'number'=>1
            ],
            [
                'round_id' => 1,
                'name'=>'Vince Sy',
                'remarks' => 'No',
                'number'=>1
            ],
        ];

        foreach($cnt as $cont) {
            \App\Models\Contestant::create([
                'round_id' => $cont['round_id'],
                'name' => $cont['name'],
                'remarks' => $cont['remarks'],
                'number' => $cont['number'],
            ]);
        }
    }
}
