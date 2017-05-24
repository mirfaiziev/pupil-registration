<?php

use Illuminate\Database\Seeder;

class SuggestNameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $handler = fopen(__DIR__.'/../../data/suggest_names.csv', 'r');
        DB::table('suggest_names')->truncate();
        while ( ($data = fgetcsv($handler)) !== false ) {
            DB::table('suggest_names')->insert([
                'name' => $data[0],
            ]);
        }
    }
}
