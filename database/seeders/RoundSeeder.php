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

        Round::create([
            'contest_id' => 1,

        ]);

        // Round::create([
        //     'contest_id' => 1,
        //     'rounds' => 2,

        // ]);
    }
}
