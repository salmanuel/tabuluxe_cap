<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
        \App\Models\Contest::create([
            'title'=>'Awit ng Tanggalan',
            'Schedule' => 'April 10, 2022',
            'venue' => 'Tubigon, Bohol',
            'user_id' => 1
        ]);

        $this->call(JudgesSeeder::class);
        $this->call(ContestantSeeder::class);
        $this->call(CriteriaSeeder::class);
    }
}
