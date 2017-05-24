<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SuggestNameSeeder::class);
        $this->command->info('Suggest names table seeded!');

        $this->call(CitiesSeeder::class);
        $this->command->info('Cities table seeded!');

        $this->call(SchoolsSeeder::class);
        $this->command->info('Schools table seeded!');
    }
}
