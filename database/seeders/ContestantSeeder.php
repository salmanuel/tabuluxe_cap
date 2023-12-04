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
                'number'=>1
            ],
            [
                'round_id' => 1,
                'name'=>'Schetznia Algova',
                'number'=>1
            ],
            [
                'round_id' => 1,
                'name'=>'Vince Sy',
                'number'=>1
            ],
        ];
    }
}
