<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\EventSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UserSeeder::class);
        $this->call(EventSeeder::class);
        \App\Models\Contest::create([
            'title'=>'Awit ng Tanggalan',
            'Schedule' => 'April 10, 2022',
            'venue' => 'Tubigon, Bohol',
            'computation' => 'Averaging',
            'event_id' => 1
        ]);

        $this->call(JudgesSeeder::class);
        $this->call(ContestantSeeder::class);
        $this->call(CriteriaSeeder::class);

    }
}
